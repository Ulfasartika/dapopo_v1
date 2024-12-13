<?php

namespace App\Http\Controllers;

use App\Imports\SiteImport;
use App\Models\Site;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::with('area')->get(); 
        return view('modul.site', compact('sites'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('modul.in_site', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'site_id' => Str::upper($request->site_id),
        ]);
        $validated = $request->validate([
            'site_id' => 'required|unique:sites',
            'site_name' => 'required',
            'address' => 'required',
            'area_id' => 'required|exists:areas,id',
        ]);

        Site::create($validated);

        return redirect()->route('site.index')->with('success', 'Site Created Successfully');
    }

    public function edit($id)
    {
        $site = Site::findOrFail($id);
        $areas = Area::all(); 
        return view('modul.edit_site', compact('site', 'areas'));
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'site_id' => Str::upper($request->site_id),
        ]);
        $validated = $request->validate([
            'site_id' => 'required|unique:sites,site_id,' . $id, 
            'site_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id'
        ]);
        $site = Site::findOrFail($id);
        $site->update($validated);

        return redirect()->route('site.index')->with('warning', 'Site updated successfully!');
    }

    public function destroy(string $id)
    {
        $data = Site::findOrFail($id);
        $data->delete();
        return redirect()->route('site.index')->with('error', 'Site Deleted Successfully!');
    }

    public function import_excel(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        $nama_file = rand().$file->getClientOriginalName();

        $file->storeAs('public/file_site', $nama_file);

        Excel::import(new SiteImport, $file);

        return redirect()->route('site.index');
    }
}
