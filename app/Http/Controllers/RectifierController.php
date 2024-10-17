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
            'user_id'        => 'required',
            'id_site'        => 'required',
            'id_pelanggan'   => 'required',
            'daya'           => 'required|numeric',
            'recti_name'     => 'required',
            'recti_brand'    => 'required',
            'apr_quantity'   => 'required|numeric',
            'bus_voltage'    => 'required|numeric',
            'load'           => 'required|numeric',
            'battery_brand'  => 'required',
            'battery_type'   => 'required',
            'battery_quantity' => 'required|numeric',
            'battery_status' => 'required',
            'backup_time'    => 'required|numeric',
            'id_equipment'   => 'required'
        ]);  
        
        $rectifier = Rectifier::create([
            'user_id'       => $request->user_id,
            'id_site'       => $request->id_site,
            'id_pelanggan'  => $request->id_pelanggan,
            'daya'          => $request->daya,
            'recti_name'    => $request->recti_name,
            'recti_brand'   => $request->recti_brand,
            'apr_quantity'  => $request->apr_quantity,
            'bus_voltage'   => $request->bus_voltage,
            'load'          => $request->load,
            'battery_brand' => $request->battery_brand,
            'battery_type'  => $request->battery_type,
            'battery_quantity' => $request->battery_quantity,
            'battery_status'=> $request->battery_status,
            'backup_time'   => $request->backup_time,
            'id_equipment'  => $request->id_equipment
        ]);

        dd($request->all());
        
        // $rectifier = Rectifier::create($request);
    
        $rectifier->sites()->attach($request['id_site']);
        $rectifier->equipments()->attach($request['id_equipment']);
        dd($rectifier);
    
        // return redirect()->route('rectifier.index')->with('success', 'Data rectifier berhasil disimpan.');
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
