<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rectifier;
use App\Models\Site;
use App\Models\DetailBattery;
use Illuminate\Http\Request;

class RectifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rectifiers = Rectifier::with(['site', 'equipments', 'batteries'])->get();
        $equipments = Equipment::all();
        return view('modul.power', compact('rectifiers', 'equipments'));
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
            'bus_voltage' => str_replace(',', '.', $request->bus_voltage),
            'load' => str_replace(',', '.', $request->load),
        ]);
    
        $validated = $request->validate([
            'id_site' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string|max:255',
            'daya' => 'required|numeric',
            'recti_name' => 'required|string|max:255',
            'recti_brand' => 'required|string|max:255',
            'apr_quantity' => 'required|integer',
            'bus_voltage' => 'required|numeric',
            'load' => 'required|numeric',
            'battery_brand' => 'required|string|max:255',
            'battery_type' => 'required|string|max:255',
            'backup_time' => 'required|integer',
            'id_equipment' => 'required|array',
            'id_equipment.*' => 'exists:equipments,id',
            'battery_quantity' => 'required|array|min:1',
            'battery_quantity.*' => 'required|integer|min:1',
            'battery_status' => 'required|array|min:1',
            'battery_status.*' => 'required|string|in:Good,Degraded',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
    
        $rectifier = Rectifier::create(array_merge($validated, ['image' => $imageName]));
    
        $rectifier->equipments()->attach($validated['id_equipment']);
    
        foreach ($validated['battery_quantity'] as $index => $quantity) {
            DetailBattery::create([
                'rectifier_id' => $rectifier->id,
                'battery_quantity' => $quantity,
                'battery_status' => $validated['battery_status'][$index],
            ]);
        }
    
        return redirect()->route('rectifier.index')->with('success', 'Rectifier Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rectifier = Rectifier::findOrFail($id);
        $sites = Site::all();
        $equipments = Equipment::all();
        return view('modul.edit_power', compact('rectifier', 'sites', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
            'bus_voltage' => str_replace(',', '.', $request->bus_voltage),
            'load' => str_replace(',', '.', $request->load),
        ]);

        $validated = $request->validate([
            'id_site' => 'required|exists:sites,id',
            'id_pelanggan' => 'required|string|max:255',
            'daya' => 'required|numeric',
            'recti_name' => 'required|string|max:255',
            'recti_brand' => 'required|string|max:255',
            'apr_quantity' => 'required|integer',
            'bus_voltage' => 'required|numeric',
            'load' => 'required|numeric',
            'battery_brand' => 'required|string|max:255',
            'battery_type' => 'required|string|max:255',
            'battery_quantity' => 'required|array|min:1',
            'battery_quantity.*' => 'required|integer|min:1',
            'battery_status' => 'required|array|min:1',
            'battery_status.*' => 'required|string|in:Good,Degraded',
            'backup_time' => 'required|integer',
            'id_equipment' => 'required|array',
            'id_equipment.*' => 'exists:equipments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $rectifier = Rectifier::findOrFail($id);

        $imageName = $rectifier->image;
        if ($request->hasFile('image')) {
            if ($imageName && file_exists(public_path('images/' . $imageName))) {
                unlink(public_path('images/' . $imageName));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        $rectifier->update(array_merge($validated, ['image' => $imageName]));

        $rectifier->equipments()->sync($validated['id_equipment']);

        $rectifier->batteries()->delete();
        foreach ($validated['battery_quantity'] as $index => $quantity) {
            DetailBattery::create([
                'rectifier_id' => $rectifier->id,
                'battery_quantity' => $quantity,
                'battery_status' => $validated['battery_status'][$index],
            ]);
        }

        return redirect()->route('rectifier.index')->with('success', 'Rectifier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rectifier = Rectifier::findOrFail($id);
        
        if ($rectifier->image && file_exists(public_path('images/' . $rectifier->image))) {
            unlink(public_path('images/' . $rectifier->image));
        }
        
        $rectifier->delete();
        return redirect()->route('rectifier.index')->with('error', 'Rectifier Successfully Deleted');
    }

    public function getRectifierCount($id)
    {
        $count = Rectifier::where('id_site', $id)->count();
        return response()->json(['count' => $count]);
    }

    public function show($id)
    {
        //
    }
}
