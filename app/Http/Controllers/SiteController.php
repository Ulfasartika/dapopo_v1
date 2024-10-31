<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\Area;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $data = Site::with('areas')->get(); 
        return view('modul.site', compact('data'));
    }

    public function create()
    {
        $areas = Area::all(); // Menampilkan semua area yang ada
        return view('modul.in_site', compact('areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|unique:sites',
            'site_name' => 'required',
            'address' => 'required',
            'area_ids' => 'required|array' // Validasi area yang dipilih
        ]);

        $site = Site::create($validated);
        $site->areas()->attach($request->area_ids); // Menyimpan area ke tabel pivot

        return redirect()->route('site.index')->with('success', 'Site Created Successfully');
    }

    public function edit($id)
    {
        $site = Site::findOrFail($id);
        $areas = Area::all();
        $selectedAreas = $site->areas->pluck('id')->toArray(); // Ambil area yang sudah dipilih
        return view('modul.edit_site', compact('site', 'areas', 'selectedAreas'));
    }
    

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'site_id' => 'required|unique:sites,site_id,' . $id, // Mengizinkan site_id yang sedang diedit
            'site_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'area_ids' => 'required|array'
        ]);
    
        // Temukan site yang akan diperbarui
        $site = Site::findOrFail($id);
    
        // Update data site
        $site->update([
            'site_id' => $validated['site_id'],
            'site_name' => $validated['site_name'],
            'address' => $validated['address'],
        ]);
    
        // Sinkronisasi area di tabel pivot
        $site->areas()->sync($validated['area_ids']);
    
        // Redirect dengan pesan sukses
        return redirect()->route('site.index')->with('success', 'Site updated successfully!');
    }
    }
