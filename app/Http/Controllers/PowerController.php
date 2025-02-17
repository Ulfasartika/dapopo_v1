<?php

namespace App\Http\Controllers;

use App\Models\BatteryBrand;
use App\Models\BatteryType;
use App\Models\Equipment;
use App\Models\Genset;
use App\Models\KwhMeter;
use App\Models\Rectifier;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RectifierExport;
use App\Imports\PowerImport;

class PowerController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // Periksa apakah user adalah admin
        if ($user->role !== 'user') {
            // Jika admin, tampilkan semua data rectifier
            $rectifiers = Rectifier::with(['site', 'batterybrand', 'batterytype', 'equipments', 'kwh', 'gensets'])->get();
        } else {
            // Jika bukan admin, tampilkan rectifier yang sesuai dengan area milik user yang login
            $rectifiers = Rectifier::with(['site', 'batterybrand', 'batterytype', 'equipments', 'kwh', 'gensets'])
                ->whereHas('site.area', function ($query) use ($user) {
                    $query->whereHas('users', function ($userQuery) use ($user) {
                        $userQuery->where('user_id', $user->id);
                    });
                })
                ->get();
        }

        $equipments = Equipment::all();
        $batterybrand = BatteryBrand::all();
        $batterytype = BatteryType::all();
        $kwhmeter = KwhMeter::all();
        $genset = Genset::all();
        return view('modul.power', compact('rectifiers', 'equipments', 'batterybrand', 'batterytype', 'kwhmeter', 'genset'));
    }

    public function storeKwh(Request $request)
    {
        Log::info('Store KwhMeter - Incoming Request:', $request->all());
    
        // Normalisasi input untuk daya
        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
        ]);
    
        try {
            // Validasi input
            $validated = $request->validate([
                'id_site' => 'required|exists:sites,id',
                'id_pelanggan' => 'required|string|max:255',
                'daya' => 'required|numeric|min:0',
                'kondisi_kwh' => 'required|string|in:Bagus,Terbakar,Bypass',
                'kondisi_segel' => 'required|string|in:Bersegel,Tidak Bersegel',
                'arus_r' => 'nullable|integer|min:0',
                'arus_s' => 'nullable|integer|min:0',
                'arus_t' => 'nullable|integer|min:0',
                'phasa_r' => 'nullable|integer|between:160,260',
                'phasa_s' => 'nullable|integer|between:160,260',
                'phasa_t' => 'nullable|integer|between:160,260',
                'foto_kwh' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }
    
        DB::beginTransaction();
    
        try {
            // Data yang akan disimpan
            $kwhData = [
                'id_site' => $validated['id_site'],
                'id_pelanggan' => $validated['id_pelanggan'],
                'daya' => $validated['daya'],
                'kondisi_kwh' => $validated['kondisi_kwh'],
                'kondisi_segel' => $validated['kondisi_segel'],
                'arus_r' => $validated['arus_r'] ?? null,
                'arus_s' => $validated['arus_s'] ?? null,
                'arus_t' => $validated['arus_t'] ?? null,
                'phasa_r' => $validated['phasa_r'] ?? null,
                'phasa_s' => $validated['phasa_s'] ?? null,
                'phasa_t' => $validated['phasa_t'] ?? null,
                'updated_by' => auth()->id(),
                'updated_at' => now(),
            ];
    
            if ($request->hasFile('foto_kwh')) {
                $file = $request->file('foto_kwh');
    
                // Validasi ulang format file sebelum menyimpan
                $allowedExtensions = ['jpeg', 'jpg', 'png'];
                if (!in_array($file->getClientOriginalExtension(), $allowedExtensions)) {
                    return response()->json(['error' => 'Invalid file format.'], 422);
                }
    
                // Simpan file ke penyimpanan publik
                $kwhData['foto_kwh'] = $file->store('uploads/kwh', 'public');
            }
    
            // Tambahkan `created_at` hanya jika record belum ada
            if (!KwhMeter::where('id_pelanggan', $validated['id_pelanggan'])->exists()) {
                $kwhData['created_at'] = now();
            }
    
            // Simpan atau update data
            $updated = KwhMeter::updateOrInsert(
                ['id_pelanggan' => $validated['id_pelanggan']], // Kondisi pencarian
                $kwhData // Data yang diperbarui atau disimpan
            );
    
            if ($updated) {
                Log::info('KwhMeter Updated or Inserted: id_pelanggan=' . $validated['id_pelanggan']);
                DB::commit();
                return response()->json(['message' => 'Data saved successfully.', 'data' => $kwhData], 200);
            } else {
                throw new \Exception('Failed to update or insert KwhMeter');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store KwhMeter - Error:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function storeRectifier(Request $request)
{
    Log::info('Store Rectifier - Incoming Request:', $request->all());

    try {
        $validated = $request->validate([
            'id_site' => 'required|exists:sites,id',
            'recti_name' => 'required|string|max:255',
            'recti_brand' => 'required|string|max:255',
            'apr_quantity' => 'required|integer|min:0',
            'bus_voltage' => 'required|numeric|between:40,60',
            'load' => 'required|numeric|between:0,200',
            'battery_brand' => 'required|exists:battery_brands,id',
            'battery_type' => 'required|exists:battery_types,battery_type',
            'total_battery' => 'required|integer|min:0',
            'good_battery' => 'nullable|integer|min:0',
            'degraded_battery' => 'nullable|integer|min:0',
            'stolen_battery' => 'nullable|integer|min:0',
            'backup_time' => 'required|integer|between:0,8',
            'id_equipment' => 'required|array',
            'id_equipment.*' => 'exists:equipments,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json(['error' => $e->validator->errors()], 422);
    }

    DB::beginTransaction();

    try {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/rectifiers', 'public');
        }

        // Siapkan data untuk disimpan
        $rectifierData = [
            'id_site' => $validated['id_site'],
            'recti_name' => $validated['recti_name'],
            'recti_brand' => $validated['recti_brand'],
            'apr_quantity' => $validated['apr_quantity'],
            'bus_voltage' => $validated['bus_voltage'],
            'load' => $validated['load'],
            'total_battery' => $validated['total_battery'],
            'good_battery' => $validated['good_battery'],
            'degraded_battery' => $validated['degraded_battery'],
            'stolen_battery' => $validated['stolen_battery'],
            'id_battery_brand' => $validated['battery_brand'],
            'id_battery_type' => BatteryType::where('battery_type', $validated['battery_type'])->value('id'),
            'backup_time' => $validated['backup_time'],
            'image' => $imagePath,
            'updated_by' => auth()->id(),
            'updated_at' => now(),
        ];

        // Tambahkan created_at jika data baru
        if (!Rectifier::where('recti_name', $validated['recti_name'])
            ->where('id_site', $validated['id_site'])->exists()) {
            $rectifierData['created_at'] = now();
        }

        // Simpan atau update data
        Rectifier::updateOrInsert(
            ['recti_name' => $validated['recti_name'], 'id_site' => $validated['id_site']],
            $rectifierData
        );

        // Ambil instance Rectifier
        $rectifierInstance = Rectifier::where('recti_name', $validated['recti_name'])
            ->where('id_site', $validated['id_site'])
            ->first();

        // Sinkronisasi equipment
        $rectifierInstance->equipments()->sync($validated['id_equipment']);

        DB::commit();
        Log::info('Store Rectifier - Transaction Committed');

        // Ambil daftar rectifier terbaru untuk site yang sama
        $rectifiers = Rectifier::where('id_site', $validated['id_site'])->get();

        return response()->json([
            'message' => 'Data saved successfully.',
            'rectifiers' => $rectifiers
        ], 200);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Store Rectifier - Error:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
    }
}

    


    public function create()
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'superuser') {
            $sites = Site::all();
        } else {
            $sites = Site::whereHas('area', function ($query) use ($user) {
                $query->whereHas('users', function ($userQuery) use ($user) {
                    $userQuery->where('user_id', $user->id);
                });
            })->get();
        }
        $equipments = Equipment::all();
        $batterybrand = BatteryBrand::all();
        $batterytype = BatteryType::all();
        return view('modul.in_power', compact('sites', 'equipments', 'batterybrand', 'batterytype'));
    }

    public function show($id)
    {
        //
    }

    public function export()
    {
        try {
            return Excel::download(new RectifierExport, 'power.xlsx');
        } catch (\Exception $e) {
            Log::error('Error exporting Rectifiers: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to export data.'], 500);
        }
    }
}
