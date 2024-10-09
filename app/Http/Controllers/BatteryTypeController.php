<?php

namespace App\Http\Controllers;

use App\Models\BatteryType;
use Illuminate\Http\Request;

class BatteryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BatteryType::all();
        return view('modul.battery_type', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modul.in_bat_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'battery_type' => 'required',
        ]);
        BatteryType::create($validated);
        return redirect()->route('battery_type.index')->with('success', 'Battery Type Created Successfully');
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
        $data = BatteryType::findOrFail($id); 
        return view('modul.edit_bat_type', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'battery_type' => 'required',
        ]);
        $data = BatteryType::findOrFail($id);
        $data->update($request->only(['battery_type']));
        return redirect()->route('battery_type.index')->with('success', 'Battery Type Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BatteryType::findOrFail($id);
        $data->delete();
        return redirect()->route('battery_type.index')->with('error', 'Battery Type Deleted Successfully!');
    }
}
