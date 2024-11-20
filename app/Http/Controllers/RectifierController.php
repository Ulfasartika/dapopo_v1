<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rectifier;
use App\Models\Site;
use App\Models\DetailBattery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class RectifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
    
        // Periksa apakah user adalah admin
        if ($user->role !== 'user') {
            // Jika admin, tampilkan semua data rectifier
            $rectifiers = Rectifier::with(['site', 'equipments', 'batteries'])->get();
        } else {
            // Jika bukan admin, tampilkan rectifier yang sesuai dengan area milik user yang login
            $rectifiers = Rectifier::with(['site', 'equipments', 'batteries'])
                ->whereHas('site.area', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        }
        
        $equipments = Equipment::all();
        return view('modul.power', compact('rectifiers', 'equipments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'superuser') {
            $sites = Site::all();
        } else {
            $sites = Site::whereHas('area', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        }
    
        $equipments = Equipment::all();
    
        return view('modul.in_power', compact('sites', 'equipments'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store Rectifier - Incoming Request:', $request->all()); // Log data request awal
    
        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
        ]);
    
        try {
            $validated = $request->validate([
                'id_site' => 'required|exists:sites,id',
                'id_pelanggan' => 'required|string|max:255',
                'daya' => 'required|numeric|min:0',
                'rectifiers.*.recti_name' => 'required|string|max:255',
                'rectifiers.*.recti_brand' => 'required|string|max:255',
                'rectifiers.*.apr_quantity' => 'required|integer|min:1',
                'rectifiers.*.bus_voltage' => 'required|numeric|min:0',
                'rectifiers.*.load' => 'required|numeric|min:0',
                'rectifiers.*.battery_brand' => 'required|string|max:255',
                'rectifiers.*.battery_type' => 'required|string|max:255',
                'rectifiers.*.backup_time' => 'required|integer|min:0',
                'rectifiers.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'rectifiers.*.id_equipment' => 'required|array',
                'rectifiers.*.id_equipment.*' => 'exists:equipments,id',
                'rectifiers.*.battery_quantity' => 'required|array|min:1',
                'rectifiers.*.battery_quantity.*' => 'required|integer|min:1',
                'rectifiers.*.battery_status' => 'required|array|min:1',
                'rectifiers.*.battery_status.*' => 'required|string|in:Good,Degraded,Stolen',
            ]);
            Log::info('Store Rectifier - Validated Data:', $validated); // Log data yang sudah divalidasi
        } catch (\Exception $e) {
            Log::error('Validation Error:', ['error' => $e->getMessage()]); // Log error validasi
            return redirect()->back()->withErrors('Validation failed: ' . $e->getMessage());
        }
    
        DB::beginTransaction();
        try {
            foreach ($validated['rectifiers'] as $index => $rectifierData) {
                Log::info("Processing Rectifier #{$index}", $rectifierData); // Log data rectifier per iterasi
    
                // Handle image upload
                $imageName = null;
                if (isset($rectifierData['image'])) {
                    $imageName = time() . '_' . uniqid() . '.' . $rectifierData['image']->extension();
                    $rectifierData['image']->move(public_path('images'), $imageName);
                    Log::info("Uploaded Image for Rectifier #{$index}: {$imageName}");
                }
    
                // Create Rectifier
                $rectifier = Rectifier::create([
                    'id_site' => $validated['id_site'],
                    'id_pelanggan' => $validated['id_pelanggan'],
                    'daya' => $validated['daya'],
                    'recti_name' => $rectifierData['recti_name'],
                    'recti_brand' => $rectifierData['recti_brand'],
                    'apr_quantity' => $rectifierData['apr_quantity'],
                    'bus_voltage' => $rectifierData['bus_voltage'],
                    'load' => $rectifierData['load'],
                    'battery_brand' => $rectifierData['battery_brand'],
                    'battery_type' => $rectifierData['battery_type'],
                    'backup_time' => $rectifierData['backup_time'],
                    'image' => $imageName,
                ]);
                Log::info("Rectifier Created: ID={$rectifier->id}");
    
                // Attach Equipments
                $rectifier->equipments()->attach($rectifierData['id_equipment']);
                Log::info("Attached Equipments to Rectifier #{$rectifier->id}: ", $rectifierData['id_equipment']);
    
                // Add Batteries
                foreach ($rectifierData['battery_quantity'] as $batteryIndex => $quantity) {
                    $battery = DetailBattery::create([
                        'rectifier_id' => $rectifier->id,
                        'battery_quantity' => $quantity,
                        'battery_status' => $rectifierData['battery_status'][$batteryIndex],
                    ]);
                    Log::info("Battery Added to Rectifier #{$rectifier->id}: ", $battery->toArray());
                }
            }
    
            DB::commit();
            Log::info('Store Rectifier - Transaction Committed');
            return redirect()->route('rectifier.index')->with('success', 'Rectifiers created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Rectifier - Error:', ['error' => $e->getMessage()]); // Log error transaksi
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
        
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rectifier = Rectifier::findOrFail($id);
        $sites = Site::all();
        $equipments = Equipment::all();
        return view('modul.edit_power', compact('rectifier', 'sites', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
        ]);

        try {
            $validated = $request->validate([
                'id_site' => 'required|exists:sites,id',
                'id_pelanggan' => 'required|string|max:255',
                'daya' => 'required|numeric|min:0',
                'rectifiers.*.recti_name' => 'required|string|max:255',
                'rectifiers.*.recti_brand' => 'required|string|max:255',
                'rectifiers.*.apr_quantity' => 'required|integer|min:1',
                'rectifiers.*.bus_voltage' => 'required|numeric|min:0',
                'rectifiers.*.load' => 'required|numeric|min:0',
                'rectifiers.*.battery_brand' => 'required|string|max:255',
                'rectifiers.*.battery_type' => 'required|string|max:255',
                'rectifiers.*.backup_time' => 'required|integer|min:0',
                'rectifiers.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'rectifiers.*.id_equipment' => 'required|array',
                'rectifiers.*.id_equipment.*' => 'exists:equipments,id',
                'rectifiers.*.battery_quantity' => 'required|array|min:1',
                'rectifiers.*.battery_quantity.*' => 'required|integer|min:1',
                'rectifiers.*.battery_status' => 'required|array|min:1',
                'rectifiers.*.battery_status.*' => 'required|string|in:Good,Degraded,Stolen',
            ]);
            Log::info('Store Rectifier - Validated Data:', $validated); // Log data yang sudah divalidasi
        } catch (\Exception $e) {
            Log::error('Validation Error:', ['error' => $e->getMessage()]); // Log error validasi
            return redirect()->back()->withErrors('Validation failed: ' . $e->getMessage());
        }

        $rectifier = Rectifier::findOrFail($id);

        try {
            foreach ($validated['rectifiers'] as $index => $rectifierData) {
                Log::info("Processing Rectifier #{$index}", $rectifierData); // Log data rectifier per iterasi
    
                // Handle image upload
                $imageName = null;
                if (isset($rectifierData['image'])) {
                    $imageName = time() . '_' . uniqid() . '.' . $rectifierData['image']->extension();
                    $rectifierData['image']->move(public_path('images'), $imageName);
                    Log::info("Uploaded Image for Rectifier #{$index}: {$imageName}");
                }
    
                // Create Rectifier
                $rectifier = Rectifier::create([
                    'id_site' => $validated['id_site'],
                    'id_pelanggan' => $validated['id_pelanggan'],
                    'daya' => $validated['daya'],
                    'recti_name' => $rectifierData['recti_name'],
                    'recti_brand' => $rectifierData['recti_brand'],
                    'apr_quantity' => $rectifierData['apr_quantity'],
                    'bus_voltage' => $rectifierData['bus_voltage'],
                    'load' => $rectifierData['load'],
                    'battery_brand' => $rectifierData['battery_brand'],
                    'battery_type' => $rectifierData['battery_type'],
                    'backup_time' => $rectifierData['backup_time'],
                    'image' => $imageName,
                ]);
                Log::info("Rectifier Created: ID={$rectifier->id}");
    
                // Attach Equipments
                $rectifier->equipments()->attach($rectifierData['id_equipment']);
                Log::info("Attached Equipments to Rectifier #{$rectifier->id}: ", $rectifierData['id_equipment']);
    
                // Add Batteries
                foreach ($rectifierData['battery_quantity'] as $batteryIndex => $quantity) {
                    $battery = DetailBattery::create([
                        'rectifier_id' => $rectifier->id,
                        'battery_quantity' => $quantity,
                        'battery_status' => $rectifierData['battery_status'][$batteryIndex],
                    ]);
                    Log::info("Battery Added to Rectifier #{$rectifier->id}: ", $battery->toArray());
                }
            }

            DB::commit();
            Log::info('Store Rectifier - Transaction Committed');
            return redirect()->route('rectifier.index')->with('success', 'Rectifiers created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Rectifier - Error:', ['error' => $e->getMessage()]); // Log error transaksi
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

        return redirect()->route('rectifier.index')->with('success', 'Rectifier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rectifier = Rectifier::findOrFail($id);
        
        if ($rectifier->image && file_exists(public_path('images/' . $rectifier->image))) {
            unlink(public_path('images/' . $rectifier->image));
        }
        
        $rectifier->delete();
        return redirect()->route('rectifier.index')->with('error', 'Rectifier Successfully Deleted');
    }

    public function getRectifierCount($id)
    {
        $count = Rectifier::where('id_site', $id)->count();
        return response()->json(['count' => $count]);
    }

    public function show($id)
    {
        //
    }
}