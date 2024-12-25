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

    public function store(Request $request)
    {
        Log::info('Store Rectifier, KwhMeter, and Gensets - Incoming Request:', $request->all());

        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
        ]);

        try {
            $validated = $request->validate($this->getValidationRules());
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withInput()->withErrors($e->validator);
        }

        DB::beginTransaction();

        try {
            $kwhMeter = $this->storeKwhMeter($validated, $request);
            $this->storeRectifiers($validated);
            $this->storeGensets($validated, $request);

            DB::commit();
            Log::info('Store Rectifier, KwhMeter, and Gensets - Transaction Committed');

            return redirect()->route('power.index')->with('success', 'Data created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Rectifier, KwhMeter, and Gensets - Error:', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Get validation rules.
     */
    private function getValidationRules(): array
    {
        return [
            'id_site' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string|max:14',
            'daya' => 'required|numeric|min:0',
            'kondisi_kwh' => 'required|string|in:Bagus,Terbakar,Bypass',
            'kondisi_segel' => 'required|string|in:Bersegel,Tidak Bersegel',
            'arus_r' => 'required|integer|min:0',
            'arus_s' => 'required|integer|min:0',
            'arus_t' => 'required|integer|min:0',
            'phasa_r' => 'nullable|integer|between:160,260',
            'phasa_s' => 'nullable|integer|between:160,260',
            'phasa_t' => 'nullable|integer|between:160,260',
            'foto_kwh' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'rectifiers' => 'required|array|min:1',
            'rectifiers.*.recti_name' => 'required|string|max:255',
            'rectifiers.*.recti_brand' => 'required|string|max:255',
            'rectifiers.*.apr_quantity' => 'required|integer|min:0',
            'rectifiers.*.bus_voltage' => 'required|numeric|between:40,60',
            'rectifiers.*.load' => 'required|numeric|between:0,200',
            'rectifiers.*.battery_brand' => 'required|exists:battery_brands,id',
            'rectifiers.*.battery_type' => 'required|exists:battery_types,battery_type',
            'rectifiers.*.total_battery' => 'required|integer|min:0',
            'rectifiers.*.good_battery' => 'nullable|integer|min:0',
            'rectifiers.*.degraded_battery' => 'nullable|integer|min:0',
            'rectifiers.*.stolen_battery' => 'nullable|integer|min:0',
            'rectifiers.*.backup_time' => 'required|integer|between:0,8',
            'rectifiers.*.id_equipment' => 'required|array',
            'rectifiers.*.id_equipment.*' => 'exists:equipments,id',
            'rectifiers.*.image' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'gensets' => 'nullable|array',
            'gensets.*.genset_name' => 'required|string|max:255',
            'gensets.*.genset_brand' => 'required|string|max:255',
            'gensets.*.capacity' => 'required|integer|min:1',
            'gensets.*.genset_condition' => 'required|string|in:Bagus,Rusak',
            'gensets.*.ats' => 'required|string|in:Bagus,Rusak',
            'gensets.*.photo_genset' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            'gensets.*.photo_ats' => 'required|image|mimes:jpeg,png,jpg|max:10000',
        ];
    }

    /**
     * Store KwhMeter data.
     */
    private function storeKwhMeter(array $validated, Request $request): void
    {
        $kwhData = [
            'id_site' => $validated['id_site'],
            'id_pelanggan' => $validated['id_pelanggan'],
        ];

        $updateData = [
            'daya' => $validated['daya'],
            'kondisi_kwh' => $validated['kondisi_kwh'],
            'kondisi_segel' => $validated['kondisi_segel'],
            'arus_r' => $validated['arus_r'],
            'arus_s' => $validated['arus_s'],
            'arus_t' => $validated['arus_t'],
            'phasa_r' => $validated['phasa_r'],
            'phasa_s' => $validated['phasa_s'],
            'phasa_t' => $validated['phasa_t'],
        ];

        if ($request->hasFile('foto_kwh')) {
            $updateData['foto_kwh'] = $request->file('foto_kwh')->store('uploads/kwh', 'public');
        }
        // Tambahkan created_at jika data baru
        if (!KwhMeter::where($kwhData)->exists()) {
            $updateData['created_at'] = now();
        }

        KwhMeter::updateOrInsert($kwhData, $updateData);
    }

    private function storeRectifiers(array $validated): void
    {
        foreach ($validated['rectifiers'] as $rectifierData) {
            $condition = [
                'id_site' => $validated['id_site'],
                'recti_name' => $rectifierData['recti_name'],
            ];

            $updateData = [
                'recti_brand' => $rectifierData['recti_brand'],
                'apr_quantity' => $rectifierData['apr_quantity'],
                'bus_voltage' => $rectifierData['bus_voltage'],
                'load' => $rectifierData['load'],
                'total_battery' => $rectifierData['total_battery'],
                'good_battery' => $rectifierData['good_battery'],
                'degraded_battery' => $rectifierData['degraded_battery'],
                'stolen_battery' => $rectifierData['stolen_battery'],
                'id_battery_brand' => $rectifierData['battery_brand'],
                'id_battery_type' => BatteryType::where('battery_type', $rectifierData['battery_type'])->value('id'),
                'backup_time' => $rectifierData['backup_time'],
            ];

            if (isset($rectifierData['image'])) {
                $updateData['image'] = $rectifierData['image']->store('uploads/rectifiers', 'public');
            }
            // Tambahkan created_at jika data baru
            if (!Rectifier::where($condition)->exists()) {
                $updateData['created_at'] = now();
            }


            $rectifier = Rectifier::updateOrInsert($condition, $updateData);

            if ($rectifier && isset($rectifierData['id_equipment'])) {
                $rectifierInstance = Rectifier::where($condition)->first();
                $rectifierInstance->equipments()->sync($rectifierData['id_equipment']);
            }
        }
    }

    private function storeGensets(array $validated): void
    {
        // Periksa apakah ada data gensets
        if (!isset($validated['gensets']) || empty($validated['gensets'])) {
            return;
        }

        foreach ($validated['gensets'] as $gensetData) {
            // Kondisi untuk update atau insert
            $condition = [
                'id_site' => $validated['id_site'],
                'genset_name' => $gensetData['genset_name'],
            ];

            // Data untuk update atau insert
            $updateData = [
                'genset_brand' => $gensetData['genset_brand'], // Disesuaikan dengan validasi
                'capacity' => $gensetData['capacity'],
                'genset_condition' => $gensetData['genset_condition'], // Disesuaikan dengan validasi
                'ats' => $gensetData['ats'],
            ];

            // Simpan file foto genset jika ada
            if (isset($gensetData['photo_genset'])) {
                $updateData['foto_genset'] = $gensetData['photo_genset']->store('uploads/gensets', 'public');
            }

            // Simpan file foto ATS jika ada
            if (isset($gensetData['photo_ats'])) {
                $updateData['foto_ats'] = $gensetData['photo_ats']->store('uploads/ats', 'public');
            }

            // Tambahkan created_at jika data baru
            if (!Genset::where($condition)->exists()) {
                $updateData['created_at'] = now();
            }

            // Lakukan update atau insert
            Genset::updateOrInsert($condition, $updateData);
        }
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
