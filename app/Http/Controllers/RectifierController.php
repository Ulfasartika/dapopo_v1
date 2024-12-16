<?php

namespace App\Http\Controllers;

use App\Exports\RectifierExport;
use App\Models\BatteryBrand;
use App\Models\BatteryType;
use App\Models\Equipment;
use App\Models\Rectifier;
use App\Models\Site;
use App\Models\DetailBattery;
use App\Models\Genset;
use App\Models\KwhMeter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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
            $rectifiers = Rectifier::with(['site', 'batteries', 'batterybrand', 'batterytype', 'equipments'])->get();
        } else {
            // Jika bukan admin, tampilkan rectifier yang sesuai dengan area milik user yang login
            $rectifiers = Rectifier::with(['site', 'batteries', 'batterybrand', 'batterytype', 'equipments' ])                
            ->whereHas('site.area', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        }
        
        $equipments = Equipment::all();
        $batterybrand = BatteryBrand::all();
        $batterytype = BatteryType::all();
        return view('modul.rectifier', compact('rectifiers', 'equipments','batterybrand', 'batterytype'));
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
        $batterybrand = BatteryBrand::all();
        $batterytype = BatteryType::all();  
        return view('modul.in_rectifier', compact('sites', 'equipments','batterybrand','batterytype'));
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Store Rectifier - Incoming Request:', $request->all());
    
        try {
            $validated = $request->validate([    
                // Validasi untuk Rectifier
                'id_site' => 'required|exists:sites,id',
                'rectifiers' => 'required|array|min:1',
                'rectifiers.*.recti_name' => 'required|string|max:255',
                'rectifiers.*.recti_brand' => 'required|string|max:255',
                'rectifiers.*.apr_quantity' => 'required|integer|min:0',
                'rectifiers.*.bus_voltage' => 'required|numeric|between:40,60',
                'rectifiers.*.load' => 'required|numeric|between:0,200',
                'rectifiers.*.battery_brand' => 'required|exists:battery_brands,id',
                'rectifiers.*.battery_type' => 'required|exists:battery_types,battery_type',
                'rectifiers.*.total_battery' => 'required|integer|min:0',
                'rectifiers.*.backup_time' => 'required|integer|between:0,8',
                'rectifiers.*.id_equipment' => 'required|array',
                'rectifiers.*.id_equipment.*' => 'exists:equipments,id',
                'rectifiers.*.battery_quantity' => 'required|array|min:0',
                'rectifiers.*.battery_quantity.*' => 'required|integer|min:0',
                'rectifiers.*.battery_status' => 'required|array|min:1',
                'rectifiers.*.battery_status.*' => 'required|string|in:Good,Degraded,Stolen',
                'rectifiers.*.image' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->validator);
        }
    
        DB::beginTransaction();
    
        try {    
            // Simpan Rectifiers
            foreach ($validated['rectifiers'] as $index => $rectifierData) {
                $imagePath = null;
                if (isset($rectifierData['image'])) {
                    $imagePath = $rectifierData['image']->store('uploads/rectifiers', 'public');
                }
    
                $rectifier = Rectifier::create([
                    'id_site' => $validated['id_site'],
                    'recti_name' => $rectifierData['recti_name'],
                    'recti_brand' => $rectifierData['recti_brand'],
                    'apr_quantity' => $rectifierData['apr_quantity'],
                    'bus_voltage' => $rectifierData['bus_voltage'],
                    'load' => $rectifierData['load'],
                    'total_battery' => $rectifierData['total_battery'],
                    'id_battery_brand' => $rectifierData['battery_brand'],
                    'id_battery_type' => BatteryType::where('battery_type', $rectifierData['battery_type'])->value('id'),
                    'backup_time' => $rectifierData['backup_time'],
                    'image' => $imagePath,
                ]);
    
                $rectifier->equipments()->attach($rectifierData['id_equipment']);
    
                foreach ($rectifierData['battery_quantity'] as $batteryIndex => $quantity) {
                    DetailBattery::create([
                        'rectifier_id' => $rectifier->id,
                        'battery_quantity' => $quantity,
                        'battery_status' => $rectifierData['battery_status'][$batteryIndex],
                    ]);
                }
            }
        
            DB::commit();
            Log::info('Store Rectifier - Transaction Committed');
            return redirect()->route('rectifier.index')->with('success', 'Data saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Rectifier - Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
                    
        
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $batterybrand=BatteryBrand::all();
        $rectifier = Rectifier::with(['batterybrand', 'batterytype'])->findOrFail($id);        
        // Mengakses Site terkait dengan Rectifier
        $site = $rectifier->site; // Ambil Site yang terkait dengan Rectifier
    
        $equipments = Equipment::all();
        return view('modul.edit_rectifier', compact('rectifier', 'site', 'equipments', 'batterybrand'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        // Validasi data request
        $validated = $request->validate([
            // Validasi untuk KwhMeter
            'id_site' => 'required|exists:sites,id',
            'recti_name' => 'required|string|max:255',
            'recti_brand' => 'required|string|max:255',
            'apr_quantity' => 'required|integer|min:1',
            'bus_voltage' => 'required|numeric|min:0',
            'load' => 'required|numeric|min:0',
            'total_battery' => 'required|integer|min:1',
            'battery_brand' => 'required|integer|exists:battery_brands,id',
            'battery_type' => 'required|string|exists:battery_types,battery_type',
            'backup_time' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'id_equipment' => 'required|array',
            'id_equipment.*' => 'integer|exists:equipments,id',
            'battery_quantity' => 'required|array',
            'battery_quantity.*' => 'required|integer|min:1',
            'battery_status' => 'required|array',
            'battery_status.*' => 'required|string|in:Good,Degraded,Stolen',
        ]);
    
        // Cari rectifier berdasarkan ID yang diteruskan
        $rectifier = Rectifier::findOrFail($id); // Menemukan rectifier yang sesuai atau error 404 jika tidak ada
    
        // Update Rectifier dengan data yang diteruskan
        $imagePath = $rectifier->image; // Jika gambar tidak diupload, gunakan gambar yang lama
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($rectifier->image && Storage::disk('public')->exists($rectifier->image)) {
                Storage::disk('public')->delete($rectifier->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('uploads/rectifiers', 'public');
        }
        $rectifier->update([
            'id_site' => $validated['id_site'],
            'recti_name' => $validated['recti_name'],
            'recti_brand' => $validated['recti_brand'],
            'apr_quantity' => $validated['apr_quantity'],
            'bus_voltage' => $validated['bus_voltage'],
            'load' => $validated['load'],
            'total_battery' => $validated['total_battery'],
            'id_battery_brand' => $validated['battery_brand'],
            'id_battery_type' => BatteryType::where('battery_type', $validated['battery_type'])->value('id'),
            'backup_time' => $validated['backup_time'],
            'image' => $imagePath, // Gambar baru atau gambar lama
        ]);
    
        // Update Equipment (melakukan attach)
        $rectifier->equipments()->sync($validated['id_equipment']);
    
        // Hapus detail baterai lama
        $rectifier->batteries()->delete();
    
        // Update Detail Battery
        if (!empty($validated['battery_quantity'])) {
            foreach ($validated['battery_quantity'] as $batteryIndex => $quantity) {
                DetailBattery::create([
                    'rectifier_id' => $rectifier->id,
                    'battery_quantity' => $quantity,
                    'battery_status' => $validated['battery_status'][$batteryIndex],
                ]);
            }
        }
    
        return redirect()->route('rectifier.index')->with('warning', 'Data updated successfully.');
        }

    /**
     * Remove the specified resource from storage.
     */

     
    public function destroy($id)
{
    // Cari data rectifier berdasarkan ID
    $rectifier = Rectifier::findOrFail($id);

    // Hapus gambar rectifier jika ada
    if ($rectifier->image && Storage::disk('public')->exists($rectifier->image)) {
        Storage::disk('public')->delete($rectifier->image);
    }

    // Hapus baterai terkait dengan rectifier
    $rectifier->batteries()->delete();

    // Hapus relasi rectifier dengan equipment
    $rectifier->equipments()->detach();

    // Hapus rectifier
    $rectifier->delete();

    return redirect()->route('rectifier.index')->with('error', 'Rectifier successfully deleted.');
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