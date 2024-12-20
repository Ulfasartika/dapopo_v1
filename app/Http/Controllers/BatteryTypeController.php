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
        $battery_type=BatteryType::all();
        return view('modul.battery_type', compact('battery_type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modul.in_battery_type');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'battery_type' => 'required',
        ]);
        BatteryType::create(array_merge(
            $request->only(['battery_type']), // Data yang diambil dari request
            ['updated_by' => auth()->id()] // Tambahkan updated_by dengan ID user yang login
        ));
        return redirect()->route('battery_type.index')->with('success', 'Battery type created successfully.');

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
        $battery_type = BatteryType::findOrFail($id); 
        return view('modul.edit_battery_type', compact('battery_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'battery_type' => 'required',
        ]);
        $battery_type = BatteryType::findOrFail($id);
        $battery_type->update(array_merge(
            $request->only(['battery_type']),
            ['updated_by' => auth()->id()]
        ));
        return redirect()->route('battery_type.index')->with('warning', 'Battery type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $battery_type = BatteryType::findOrFail($id); 
        $battery_type->delete();
        return redirect()->route('battery_type.index')->with('error', 'Battery type deleted successfully.');
    }
}
