<?php

namespace App\Imports;

use App\Models\Rectifier;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RectifierImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
public function model(array $row)
{
    $idSite = (string)$row['id_site'];
    $site = Site::where('site_id', $idSite)->first();
    if (!$site) {
        throw new \Exception("Site dengan site_id '{$row['id_site']}' tidak ditemukan.");
    }

    // Cari ID battery_brand berdasarkan nama
    $batteryBrand = \App\Models\BatteryBrand::where('battery_brand', $row['battery_brand'])->first();
    if (!$batteryBrand) {
        throw new \Exception("Battery brand '{$row['battery_brand']}' tidak ditemukan.");
    }

    // Cari ID battery_type berdasarkan nama
    $batteryType = \App\Models\BatteryType::where('battery_type', $row['battery_type'])->first();
    if (!$batteryType) {
        throw new \Exception("Battery type '{$row['battery_type']}' tidak ditemukan.");
    }

    return new Rectifier([
        'id_site'           => $site->id,
        'recti_name'        => $row['recti_name'],
        'recti_brand'       => $row['recti_brand'],
        'apr_quantity'      => $row['apr_quantity'],
        'bus_voltage'       => $row['bus_voltage'],
        'load'              => $row['load'],
        'id_battery_brand'  => $batteryBrand->id,
        'id_battery_type'   => $batteryType->id,
        'backup_time'       => $row['backup_time'],
        'total_battery'     => $row['total_battery'],
        'good_battery'      => $row['good_battery'],
        'degraded_battery'  => $row['degraded_battery'],
        'stolen_battery'    => $row['stolen_battery'],
    ]);
}

public function rules(): array
{
    return [
        'id_site'           => 'required|exists:sites,site_id',
        'recti_name'        => 'required|string',
        'recti_brand'       => 'required|string',
        'apr_quantity'      => 'required|int',
        'bus_voltage'       => 'required|numeric',
        'load'              => 'required|numeric',
        'battery_brand'     => 'required|string|exists:battery_brands,battery_brand',
        'battery_type'      => 'required|string|exists:battery_types,battery_type',
        'backup_time'       => 'required|int',
        'total_battery'     => 'required|int',
        'good_battery'      => 'required|int',
        'degraded_battery'  => 'required|int',
        'stolen_battery'    => 'required|int',
    ];
}
}
