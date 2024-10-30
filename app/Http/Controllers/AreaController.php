<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Area::all();
        return view('modul.area', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modul.in_area');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'area' => 'required',
        ]);
        Area::create($validated);
        return redirect()->route('area.index')->with('success', 'Area Created Successfully');
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
        $data = Area::findOrFail($id); 
        return view('modul.edit_area', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'area' => 'required',
        ]);
        $data = Area::findOrFail($id);
        $data->update($request->only(['area']));
        return redirect()->route('area.index')->with('success', 'Area Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Area::findOrFail($id);
        $data->delete();
        return redirect()->route('area.index')->with('error', 'Area Deleted Successfully!');
    }
}
