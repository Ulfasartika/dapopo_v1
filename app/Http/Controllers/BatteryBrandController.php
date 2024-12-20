<?php

namespace App\Http\Controllers;

use App\Models\BatteryBrand;
use Illuminate\Http\Request;

class BatteryBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $battery_brand = BatteryBrand::all();
        return view('modul.battery_brand', compact('battery_brand'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modul.in_battery_brand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'battery_brand' => 'required',
        ]);
        BatteryBrand::create(array_merge(
            $request->only(['battery_brand']), // Data yang diambil dari request
            ['updated_by' => auth()->id()] // Tambahkan updated_by dengan ID user yang login
        ));
        return redirect()->route('battery_brand.index')->with('success', 'Battery Brand Created Successfully');

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
        $battery_brand = BatteryBrand::findOrFail($id); 
        return view('modul.edit_battery_brand', compact('battery_brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'battery_brand' => 'required',
        ]);
        $battery_brand = BatteryBrand::findOrFail($id);
        $battery_brand->update(array_merge(
            $request->only(['battery_brand']),
            ['updated_by' => auth()->id()]
        ));
        return redirect()->route('battery_brand.index')->with('warning', 'Battery Brand Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $battery_brand = BatteryBrand::findOrFail($id); 
        $battery_brand->delete();
        return redirect()->route('battery_brand.index')->with('error', 'Battery Brand Deleted Successfully.');
    }
}
