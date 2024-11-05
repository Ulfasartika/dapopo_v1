<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rectifier;
use App\Models\Site;
use App\Models\Battery;
use Illuminate\Http\Request;

class RectifierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rectifiers = Rectifier::with(['sites', 'equipments'])->get();
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
            'id_equipment.*' => 'exists:equipment,id',
           'battery_quantity' => 'required|array|min:1',
            'battery_quantity.*' => 'required|integer|min:1',
            'battery_status' => 'required|array|min:1',
            'battery_status.*' => 'required|string|in:Good,Degraded',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = null;
        }

        $rectifier = Rectifier::create([
            'id_site' => $validated['id_site'],
            'id_pelanggan' => $validated['id_pelanggan'],
            'daya' => $validated['daya'],
            'recti_name' => $validated['recti_name'],
            'recti_brand' => $validated['recti_brand'],
            'apr_quantity' => $validated['apr_quantity'],
            'bus_voltage' => $validated['bus_voltage'],
            'load' => $validated['load'],
            'battery_brand' => $validated['battery_brand'],
            'battery_type' => $validated['battery_type'],
            'backup_time' => $validated['backup_time'],
            'image' => $imageName,
        ]);
        $rectifier->sites()->attach($validated['id_site']);
        $rectifier->equipments()->attach($validated['id_equipment']);

        foreach ($validated['battery_quantity'] as $index => $quantity) {
            Battery::create([
                'rectifier_id' => $rectifier->id,
                'battery_quantity' => $quantity,
                'battery_status' => $validated['battery_status'][$index],
            ]);
        }
        return redirect()->route('rectifier.index')->with('success', 'Rectifier Created Successfully');
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
        // Mengubah format nilai daya, bus_voltage, dan load
        $request->merge([
            'daya' => str_replace(',', '.', $request->daya),
            'bus_voltage' => str_replace(',', '.', $request->bus_voltage),
            'load' => str_replace(',', '.', $request->load),
        ]);

        // Validasi input
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
            'battery_quantity' => 'required|integer',
            'battery_status' => 'required|string|max:255',
            'backup_time' => 'required|integer',
            'id_equipment' => 'required|array',
            'id_equipment.*' => 'exists:equipment,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Temukan data rectifier yang akan diperbarui
        $rectifier = Rectifier::findOrFail($id);

        // Jika pengguna mengunggah gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($rectifier->image && file_exists(public_path('images/' . $rectifier->image))) {
                unlink(public_path('images/' . $rectifier->image));
            }

            // Unggah gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        } else {
            // Tetap gunakan gambar lama jika tidak ada gambar baru yang diunggah
            $imageName = $rectifier->image;
        }

        // Update data rectifier
        $rectifier->update([
            'id_site' => $validated['id_site'],
            'id_pelanggan' => $validated['id_pelanggan'],
            'daya' => $validated['daya'],
            'recti_name' => $validated['recti_name'],
            'recti_brand' => $validated['recti_brand'],
            'apr_quantity' => $validated['apr_quantity'],
            'bus_voltage' => $validated['bus_voltage'],
            'load' => $validated['load'],
            'battery_brand' => $validated['battery_brand'],
            'battery_type' => $validated['battery_type'],
            'battery_quantity' => $validated['battery_quantity'],
            'battery_status' => $validated['battery_status'],
            'backup_time' => $validated['backup_time'],
            'image' => $imageName, // Simpan nama file gambar yang diperbarui atau tetap gunakan yang lama
        ]);

        // Sinkronisasi relasi dengan site dan equipment
        $rectifier->sites()->sync([$validated['id_site']]);
        $rectifier->equipments()->sync($validated['id_equipment']);

        // Redirect dengan pesan sukses
        return redirect()->route('rectifier.index')->with('success', 'Rectifier Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rectifier = Rectifier::findOrFail($id);
        $rectifier->delete();
        return redirect()->route('rectifier.index')->with('error', 'Rectifier Successfully Deleted');
    }

    public function getRectifierCount($id)
    {
        // Hitung jumlah rectifier yang sudah ada di site tertentu
        $count = Rectifier::where('id_site', $id)->count();
        return response()->json(['count' => $count]);
    }
}
