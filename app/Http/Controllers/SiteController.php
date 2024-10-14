<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $data = Site::all();
        return view('modul.site', compact('data'));
    }

    public function create()
    {
        return view('modul.in_site');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|unique:sites',
            'site_name' => 'required',
            'area'=> 'required',
            'address' => 'required',
        ]);
        Site::create($validated);
        return redirect()->route('site.index')->with('success', 'Site Create Successfully');
    }

    public function destroy(string $id)
    {
        $site = Site::findOrFail($id);
        $site->delete();
        return redirect()->route('site.index')->with('error', 'Site Successfully Deleted');
    }

    public function edit($id)
    {
        $site = Site::findOrFail($id); 
        return view('modul.edit_site', compact('site'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'site_id' => 'required|unique:sites,site_id,' . $id,
            'site_name' => 'required',
            'area'=>'area',
            'address' => 'required',
        ]);
        $site = Site::findOrFail($id);
        $site->update($request->only(['site_id', 'site_name','area', 'address']));
        return redirect()->route('site.index')->with('success', 'Site updated successfully!');
    }
}
