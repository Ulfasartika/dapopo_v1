<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Equipmentrectifier;
use App\Models\Rectifier;
use App\Models\Rectisite;
use App\Models\Site;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RectifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rectifiers = Rectifier::with('sites')->get();
        return view('modul.power', compact('rectifiers'));
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
        $validated = $request->validate([
            'id_site' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string|max:255',
            'daya' => 'required|integer',
            'recti_name' => 'required|string|max:255',
            'recti_brand' => 'required|string|max:255',
            'apr_quantity' => 'required|integer',
            'bus_voltage' => 'required|integer',
            'load' => 'required|integer',
            'battery_brand' => 'required|string|max:255',
            'battery_type' => 'required|string|max:255',
            'battery_quantity' => 'required|integer',
            'battery_status' => 'required|string|max:255',
            'backup_time' => 'required|integer',
            'id_equipment.*' => 'exists:equipment,id',
        ]);

        $rectifier = Rectifier::create([
            'id_site' => $validated['id_site'],
            'id_pelanggan' => $validated['id_pelanggan'],
            'daya' => $validated['daya'],
            'recti_name' => $validated['recti_name'],
            'recti_brand' => $validated['recti_brand'],
            'apr_quantity' => $validated['apr_quantity'],
            'bus_voltage' => $validated['bus_voltage'],
            'load' => $validated['load'],
            'battery_brand' => $validated['battery_brand'],
            'battery_type' => $validated['battery_type'],
            'battery_quantity' => $validated['battery_quantity'],
            'battery_status' => $validated['battery_status'],
            'backup_time' => $validated['backup_time'],
            'id_equipment' => json_encode(value: $validated['id_equipment']),
        ]);

        return redirect()->route('rectifier.index')->with('success','Rectifier Created Successfully');
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
