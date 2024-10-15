<?php

namespace App\Http\Controllers;

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
        $rectifiers = Rectifier::all();
        $sites = Site::all();
        return view('modul.power', compact('rectifiers', 'sites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createStepOne(Request $request)
    {
        $sites = Site::all();
        $rectifiers = $request->session()->get('rectifiers');
        return view('modul.in_power', compact('rectifiers', 'sites'));
    }

    public function postCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'id_site' => 'required',
        ]);

        if(empty($request->session()->get('rectifiers'))){
            $rectifiers = new Rectifier();
            $rectifiers->fill($validatedData);
            $request->session()->put('rectifiers', $rectifiers);
        }else{
            $rectifiers = $request->session()->get('rectifiers');
            $rectifiers->fill($validatedData);
            $request->session()->put('rectifiers',$rectifiers);
        }
        return redirect()->route('rectifier.create.step.two');
    }

    public function createStepTwo(Request $request)
    {
        $rectifiers = $request->session()->get('rectifiers');
        return view('rectifier.create-step-two', compact('rectifiers'));
    }

    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'id_pelanggan' => 'required',
            'daya' => 'required',
        ]);

        $rectifiers = $request->session()->get('rectifiers');
        $rectifiers->fill($validatedData);
        $request->session()->put('rectifiers', $rectifiers);
        return redirect()->route('rectifier.create.step.three');
    }

    public function createStepThree(Request $request)
    {
        $rectifiers = $request->session()->get('rectifiers');
        return view('rectifier.create-step-three', compact('rectifiers'));
    }

    public function postCreateStepThree(Request $request)
    {
        $validatedData = $request->validate([
            'recti_name' => 'required',
            'recti_brand' => 'required',
            'apr_quantity' => 'required',
            'bus_voltage' => 'required',
            'load' => 'required',
            'battery_brand' => 'required',
            'battery_type' => 'required',
            'battery_quantity' => 'required',
            'battery_status' => 'required',
            'backup_time' => 'required',
            'id_equipment'=>'required',
        ]);

        $rectifiers = $request->session()->get('rectifiers');
        $rectifiers->fill($validatedData);
        $request->session()->put('rectifiers', $rectifiers);
        return redirect()->route('rectifier.index');
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
