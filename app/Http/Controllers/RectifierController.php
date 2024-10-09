<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\BatteryType;
use App\Models\Equipment;
use App\Models\Rectifier;
use App\Models\Site;
use Illuminate\Http\Request;

class RectifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rectifier::with('site')->get(); 
        return view('modul.power', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sites = Site::all(); 
        $batteries = Battery::all();
        $battery_type = BatteryType::all();
        $equipments = Equipment::all();
        return view('modul.rectifier', compact('sites', 'batteries', 'battery_type','equipments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
