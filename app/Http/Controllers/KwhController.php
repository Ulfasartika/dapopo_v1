<?php

namespace App\Http\Controllers;

use App\Models\KwhMeter;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KwhController extends Controller
{
    public function index()
    {
        $user = Auth::user();
    
        // Periksa apakah user adalah admin
        if ($user->role !== 'user') {
            // Jika admin, tampilkan semua data kwh
            $kwh = KwhMeter::with(['site'])->get();
        } else {
            // Jika bukan admin, tampilkan kwh yang sesuai dengan area milik user yang login
            $kwh = KwhMeter::with(['site'])                
            ->whereHas('site.area', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        }
        
        $kwh = KwhMeter::all();
        return view('modul.kwh', compact('kwh'));
    }

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
    
        return view('modul.in_kwh', compact('sites'));
    }

    public function store(Request $request)
    {
        Log::info('Store KwhMeter - Incoming Request:', $request->all());
    
        // Normalisasi input untuk daya
        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
        ]);
    
        try {
            $validated = $request->validate([
                // Validasi untuk KwhMeter
                'id_site' => 'required|exists:sites,id',
                'id_pelanggan' => 'required|string|max:255',
                'daya' => 'required|numeric|min:0',
                'kondisi_kwh' => 'required|string|in:Bagus,Terbakar,Bypass',
                'arus_pln' => 'required|integer|min:0',
                'phasa_1' => 'nullable|integer|between:160,260',
                'phasa_2' => 'nullable|integer|between:160,260',
                'phasa_3' => 'nullable|integer|between:160,260',
                'foto_kwh' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
       ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->validator);
        }
    
        DB::beginTransaction();
    
        try {
            // Step 1: Simpan KwhMeter
            $kwhData = [
                'id_site' => $validated['id_site'],
                'id_pelanggan' => $validated['id_pelanggan'],
                'daya' => $validated['daya'],
                'kondisi_kwh' => $validated['kondisi_kwh'],
                'arus_pln' => $validated['arus_pln'],
                'phasa_1' => $validated['phasa_1'],
                'phasa_2' => $validated['phasa_2'],
                'phasa_3' => $validated['phasa_3'],
            ];
    
            if ($request->hasFile('foto_kwh')) {
                $kwhData['foto_kwh'] = $request->file('foto_kwh')->store('uploads/kwh', 'public');
            }
    
            $kwhMeter = KwhMeter::create($kwhData);
            Log::info('KwhMeter Created: ID=' . $kwhMeter->id);
    
            DB::commit();
            Log::info('Store KwhMeter - Transaction Committed');
            return redirect()->route('kwh.index')->with('success', 'Data saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store KwhMeter - Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Ambil data KwhMeter beserta relasi site
        $kwh = KwhMeter::with('site')->findOrFail($id);
    
        // Ambil semua data site untuk dropdown
        $site = Site::all();
    
        // Tampilkan view edit dengan data
        return view('modul.edit_kwh', compact('kwh', 'site'));
    }
    public function update(Request $request, $id)
    {
        
        // Validasi data request
        $validated = $request->validate([
            // Validasi untuk KwhMeter
            'id_site' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string|max:255',
            'daya' => 'required|numeric|min:0',
            'kondisi_kwh' => 'required|string|in:Bagus,Terbakar,Bypass',
            'arus_pln' => 'required|integer|min:0',
            'phasa_1' => 'nullable|integer|between:160,260',
            'phasa_2' => 'nullable|integer|between:160,260',
            'phasa_3' => 'nullable|integer|between:160,260',
            'foto_kwh' => 'nullable|image|mimes:jpeg,png,jpg|max:10000',
        ]);
            
        $kwhMeter = KwhMeter::where('id_site', $validated['id_site'])->firstOrFail();
        $kwhMeterData = [
            'id_pelanggan' => $validated['id_pelanggan'],
            'daya' => $validated['daya'],
            'kondisi_kwh' => $validated['kondisi_kwh'],
            'arus_pln' => $validated['arus_pln'],
            'phasa_1' => $validated['phasa_1'],
            'phasa_2' => $validated['phasa_2'],
            'phasa_3' => $validated['phasa_3'],
        ];

        if ($request->hasFile('foto_kwh')) {
            // Hapus gambar lama jika ada
            if ($kwhMeter->foto_kwh && Storage::disk('public')->exists($kwhMeter->foto_kwh)) {
                Storage::disk('public')->delete($kwhMeter->foto_kwh);
            }
            // Simpan gambar baru
            $kwhMeterData['foto_kwh'] = $request->file('foto_kwh')->store('uploads/kwh', 'public');
        }

        $kwhMeter->update($kwhMeterData);
        Log::info('KwhMeter Updated: ID=' . $kwhMeter->id);
        return redirect()->route('kwh.index')->with('success', 'Data updated successfully.');
        }

        public function destroy($id)
{
    // Cari data rectifier berdasarkan ID
    $kwh = KwhMeter::findOrFail($id);

    // Hapus gambar rectifier jika ada
    if ($kwh->foto_kwh && Storage::disk('public')->exists($kwh->foto_kwh)) {
        Storage::disk('public')->delete($kwh->foto_kwh);
    }
    // Hapus rectifier
    $kwh->delete();

    return redirect()->route('kwh.index')->with('success', 'KWh Meter successfully deleted.');
}


    

}
