<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('sites', 'users', 'updatedBy')->get();
        return view('modul.area', compact('areas'));
    }

    public function create()
    {
        $users = User::all();
        return view('modul.in_area', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id', 
        ]);

        $area = Area::create([
            'area' => $request->area,
            'updated_by' => auth()->id(),
        ]);
        $area->users()->attach($request->user_ids);
        return redirect()->route('area.index')->with('success', 'Area created successfully.');
    }

    public function show(Area $area)
    {
        //
    }

    public function edit($id)
    {
        $area = Area::with('users')->findOrFail($id);
        $users = User::all(); 
        return view('modul.edit_area', compact('area', 'users'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',        ]);

            $area->update([
                'area' => $request->area,
                'updated_by' => auth()->id(),
            ]);   
            $area->users()->sync($request->user_ids);     
            return redirect()->route('area.index')->with('warning', 'Area updated successfully.');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('area.index')->with('error', 'Area deleted successfully.');
    }
}
