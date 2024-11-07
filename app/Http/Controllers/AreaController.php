<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('sites', 'user')->get();
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
            'user_id' => 'required|exists:users,id',
        ]);

        Area::create($request->only(['area', 'user_id']));

        return redirect()->route('area.index')->with('success', 'Area created successfully.');
    }

    public function show(Area $area)
    {
        //
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $users = User::all(); 
        return view('modul.edit_area', compact('area', 'users'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'area' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $area->update($request->only(['area', 'user_id']));

        return redirect()->route('area.index')->with('success', 'Area updated successfully.');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('area.index')->with('success', 'Area deleted successfully.');
    }
}
