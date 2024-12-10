<?php

namespace App\Http\Controllers;

use App\Exports\GensetExport;
use App\Models\Genset;
use App\Models\KwhMeter;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class GensetController extends Controller
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
            $genset = Genset::with(['site'])->get();
        } else {
            // Jika bukan admin, tampilkan rectifier yang sesuai dengan area milik user yang login
            $genset = Genset::with(['site'])                
            ->whereHas('site.area', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->get();
        }   
        $genset = Genset::all();
        return view('modul.genset', compact('genset'));
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
        return view('modul.in_genset', compact('site'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                // Validasi untuk Genset
                'id_site' => 'required|exists:sites,id',
                'gensets' => 'nullable|array',
                'gensets.*.brand' => 'required|string|max:255',
                'gensets.*.capacity' => 'required|integer|min:1',
                'gensets.*.condition' => 'required|string|in:Good,Damaged',
                'gensets.*.ats' => 'required|string|in:Good,Damaged',
                'gensets.*.photo_genset' => 'required|image|mimes:jpeg,png,jpg|max:10000',
                'gensets.*.photo_ats' => 'required|image|mimes:jpeg,png,jpg|max:10000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->validator);
        }

        DB::beginTransaction();

        try {
            foreach ($validated['gensets'] as $index => $gensetData) {
                $photoGensetPath = $gensetData['photo_genset']->store('uploads/gensets', 'public');
                $photoAtsPath = $gensetData['photo_ats']->store('uploads/ats', 'public');
        
                Genset::create([
                    'id_site' => $validated['id_site'],
                    'genset_brand' => $gensetData['brand'],
                    'capacity' => $gensetData['capacity'],
                    'genset_condition' => $gensetData['condition'],
                    'ats' => $gensetData['ats'],
                    'foto_genset' => $photoGensetPath,
                    'foto_ats' => $photoAtsPath,
                ]);
            }
        
            DB::commit();
            Log::info('Store Gensets - Transaction Committed');
            return redirect()->route('genset.index')->with('success', 'Data saved successfully.');
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
        $genset = Genset::findOrFail($id);
        $site = Site::all();
        return view('modul.edit_genset',compact('site','genset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data
        $validatedData = $request->validate([
            'id_site' => 'required|exists:sites,id',
            'genset_brand' => 'required|string|max:255',
            'capacity' => 'required|numeric',
            'genset_condition' => 'required|in:Good,Damaged',
            'ats' => 'required|in:Good,Damaged',
            'foto_ats' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'foto_genset' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);
    
        // Temukan data genset berdasarkan ID
        $genset = Genset::findOrFail($id);
    
        // Update data teks
        $genset->id_site = $validatedData['id_site'];
        $genset->genset_brand = $validatedData['genset_brand'];
        $genset->capacity = $validatedData['capacity'];
        $genset->genset_condition = $validatedData['genset_condition'];
        $genset->ats = $validatedData['ats'];
    
        // Update gambar ATS jika ada
        if ($request->hasFile('foto_ats')) {
            // Hapus gambar lama jika ada
            if ($genset->foto_ats) {
                Storage::disk('public')->delete($genset->foto_ats);
            }
            // Simpan gambar baru
            $genset->foto_ats = $request->file('foto_ats')->store('uploads/ats', 'public');
        }
    
        // Update gambar Genset jika ada
        if ($request->hasFile('foto_genset')) {
            // Hapus gambar lama jika ada
            if ($genset->foto_genset) {
                Storage::disk('public')->delete($genset->foto_genset);
            }
            // Simpan gambar baru
            $genset->foto_genset = $request->file('foto_genset')->store('uploads/gensets', 'public');
        }
    
        // Simpan data
        $genset->save();
    
        // Redirect dengan pesan sukses
        return redirect()->route('genset.index')->with('success', 'Genset updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $genset = Genset::findOrFail($id);
    
        // Hapus gambar pertama jika ada
        if ($genset->foto_ats) {
            Storage::disk('public')->delete($genset->foto_ats);
    
        // Hapus gambar kedua jika ada
        if ($genset->foto_genset) {
            Storage::disk('public')->delete($genset->foto_genset); 
        }
    
        // Hapus data rectifier
        $genset->delete();
    
        // Redirect dengan pesan sukses
        return redirect()->route('genset.index')->with('success', 'Genset Successfully Deleted');
    }}

}
