<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\BatteryType;
use App\Models\Equipment;
use App\Models\Kwh;
use App\Models\Rectifier;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;

class RectifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $equipment = Rectifier::with('site')->get();
        $data = Rectifier::with('site')->get(); 
        return view('modul.power', compact('data', 'equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createStepOne()
    {
        $sites = Site::all(); 
        return view('modul.create-step-one', compact('sites'));
    }

    public function postCreateStepOne(Request $request)
    {
        $validatedData = $request->validate([
            'id_site' => 'required',
        ]);
  
        if(empty($request->session()->get('rectifier'))){
            $rectifier = new Rectifier();
            $rectifier->fill($validatedData);
            $request->session()->put('rectifier', $rectifier);
        }else{
            $rectifier = $request->session()->get('rectifier');
            $rectifier->fill($validatedData);
            $request->session()->put('rectifier', $rectifier);
        }
  
        return redirect()->route('rectifier.create.step.two');
    }

    public function createStepTwo(Request $request)
    {
        $rectifier = $request->session()->get('rectifier');
  
        return view('modul.create-step-two',compact('rectifier'));
    }

    public function postCreateStepTwo(Request $request)
    {
        $validatedData = $request->validate([
            'id_pelanggan' => 'required',
            'daya' => 'required',
        ]);
  
        $rectifier = $request->session()->get('rectifier');
        $rectifier->fill($validatedData);
        $request->session()->put('rectifier', $rectifier);
  
        return redirect()->route('rectifier.create.step.three');
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
