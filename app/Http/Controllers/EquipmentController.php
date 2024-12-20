<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Equipment::with('updatedBy')->get();
        return view('modul.equipment', compact('equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modul.in_equipment');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_name' => 'required',
        ]);
        Equipment::create(array_merge(
            $request->only(['equipment_name']), // Data yang diambil dari request
            ['updated_by' => auth()->id()] // Tambahkan updated_by dengan ID user yang login
        ));

        return redirect()->route('equipment.index')->with('success', 'Equipment Created Successfully');
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
        $data = Equipment::findOrFail($id); 
        return view('modul.edit_equipment', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'equipment_name' => 'required',
        ]);
        $data = Equipment::findOrFail($id);
        $data->update(array_merge(
            $request->only(['equipment_name']),
            ['updated_by' => auth()->id()]
        ));
        return redirect()->route('equipment.index')->with('warning', 'Equipment Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Equipment::findOrFail($id);
        $data->delete();
        return redirect()->route('equipment.index')->with('error', 'Equipment Deleted Successfully!');
    }
}
