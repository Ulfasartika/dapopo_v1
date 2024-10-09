<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use Illuminate\Http\Request;

class BatteryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Battery::all();
        return view('modul.battery', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modul.in_battery');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk_battery' => 'required',
        ]);
        Battery::create($validated);
        return redirect()->route('battery.index')->with('success', 'Battery Created Successfully');
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
        $data = Battery::findOrFail($id); 
        return view('modul.edit_battery', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'merk_battery' => 'required',
        ]);
        $data = Battery::findOrFail($id);
        $data->update($request->only(['merk_battery']));
        return redirect()->route('battery.index')->with('success', 'Battery Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Battery::findOrFail($id);
        $data->delete();
        return redirect()->route('battery.index')->with('error', 'Battery Deleted Successfully!');
    }
}
