<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rectifier;
use App\Models\Site;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class RectifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rectifiers = Rectifier::all();
        $sites = Site::all();
        return view('modul.power', compact('rectifiers', 'sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites = Site::all();
        $equipments = Equipment::all();
        return view('modul.in_power', compact('sites', 'equipments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'id_site' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string',
            'daya' => 'required|integer',
            'recti_name' => 'required|string',
            'recti_brand' => 'required|string',
            'apr_quantity' => 'required|integer',
            'bus_voltage' => 'required|integer',
            'load' => 'required|integer',
            'battery_brand' => 'required|string',
            'battery_type' => 'required|string',
            'battery_quantity' => 'required|integer',
            'battery_status' => 'required|string',
            'backup_time' => 'required|integer',
            'id_equipment' => 'required|array',
            'id_equipment.*' => 'exists:equipment,id',
        ]);
    
        dd($request->all());
    
        $rectifier = Rectifier::create($validatedData);
    
        $rectifier->sites()->attach($validatedData['id_site']);
        $rectifier->equipments()->attach($validatedData['id_equipment']);
    
        return redirect()->route('rectifier.index')->with('success', 'Data rectifier berhasil disimpan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
