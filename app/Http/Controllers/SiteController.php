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
        $validated = $request->validate([
            'site_id' => 'required|unique:sites,site_id,' . $id,
            'site_name' => 'required',
            'address' => 'required',
            'area_ids' => 'required|array'
        ]);

        $site = Site::findOrFail($id);
        $site->update($validated);
        $site->areas()->sync($request->area_ids); // Update area di tabel pivot

        return redirect()->route('site.index')->with('success', 'Site updated successfully!');
    }
}
