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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();    
        if ($user->role !== 'user') {
            $kwh = KwhMeter::with(['site'])->get();
        } else {
            $kwh = KwhMeter::with(['site'])                
            ->whereHas('site.area', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        }   
        $kwh = KwhMeter::all();
        return view('modul.kwh', compact('kwh'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->role === 'admin' || $user->role === 'superuser') {
            $site = Site::all();
        } else {
            $site = Site::whereHas('area', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        }
        return view('modul.in_kwh', compact('site'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Validasi untuk KWh
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
            Log::info('Store Gensets - Transaction Committed');
            return redirect()->route('kwh.index')->with('success', 'Data saved successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Gensets - Error:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kwh = KwhMeter::with(['site'])->findOrFail($id);        
        $site = Site::all();
        return view('modul.edit_kwh',compact('site','kwh'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data
        $validatedData = $request->validate([
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
    
        // Temukan data genset berdasarkan ID
        $kwh = KwhMeter::findOrFail($id);
    
        // Update data teks
        $kwh->id_site = $validatedData['id_site'];
        $kwh->id_pelanggan = $validatedData['id_pelanggan'];
        $kwh->daya = $validatedData['daya'];
        $kwh->kondisi_kwh = $validatedData['kondisi_kwh'];
        $kwh->arus_pln = $validatedData['arus_pln'];
        $kwh->phasa_1 = $validatedData['phasa_1'];
        $kwh->phasa_2 = $validatedData['phasa_2'];
        $kwh->phasa_3 = $validatedData['phasa_3'];

    
        // Update gambar ATS jika ada
        if ($request->hasFile('foto_kwh')) {
            // Hapus gambar lama jika ada
            if ($kwh->foto_kwh) {
                Storage::disk('public')->delete($kwh->foto_kwh);
            }
            // Simpan gambar baru
            $kwh->foto_kwh = $request->file('foto_kwh')->store('uploads/kwh', 'public');
        }
    
        // Simpan data
        $kwh->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('kwh.index')->with('success', 'KWh Meter updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kwh = KwhMeter::findOrFail($id);
        
        if ($kwh->foto_kwh) {
            Storage::disk('public')->delete($kwh->foto_kwh); // Menghapus file dari storage/public
        }
        
        $kwh->delete();
    
        return redirect()->route('kwh.index')->with('success', 'KWh Meter Successfully Deleted');

    }
}
