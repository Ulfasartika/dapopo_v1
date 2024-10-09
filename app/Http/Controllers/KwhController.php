<?php

namespace App\Http\Controllers;

use App\Models\Kwh;
use App\Models\Site;
use Illuminate\Http\Request;

class KwhController extends Controller
{
    // Menampilkan semua data Kwh
    public function index()
    {
        // Mengambil data Kwh beserta relasinya ke Site
        $data = Kwh::with('site')->get(); 
        return view('modul.kwh', compact('data'));
    }

    // Menampilkan form input Kwh baru
    public function create()
    {
        // Mengambil semua data site
        $sites = Site::all(); 
        return view('modul.in_kwh', compact('sites'));
    }

    // Menyimpan data Kwh baru
    public function store(Request $request)
    {        
        $validatedData = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string',
            'daya' => 'required|integer',
        ]);
        
        Kwh::create($validatedData);
        
        return redirect()->route('kwh.index')->with('success', 'Kwh created successfully');
    }
    

    // Menampilkan form edit Kwh
    public function edit($id)
    {
        // Mencari data Kwh berdasarkan ID
        $kwh = Kwh::findOrFail($id);
        // Mengambil semua data site untuk dropdown
        $sites = Site::all();
        return view('modul.edit_kwh', compact('kwh', 'sites'));
    }

    // Mengupdate data Kwh yang ada
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string',
            'daya' => 'required|integer',
        ]);
    
        // Memperbarui data Kwh
        Kwh::findOrFail($id)->update($validatedData);
    
        return redirect()->route('kwh.index')->with('success', 'Kwh updated successfully');
    }

    // Menghapus data Kwh
    public function destroy($id)
    {
        Kwh::deleteKwh($id);
    
        return redirect()->route('kwh.index')->with('error', 'Kwh deleted successfully');
    }
}
