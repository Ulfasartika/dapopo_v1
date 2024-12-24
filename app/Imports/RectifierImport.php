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

        return new Rectifier([
            'id_site'           => $site->id,
            'recti_name'        => $row['recti_name'],
            'recti_brand'       => $row['recti_brand'],
            'apr_quantity'      => $row['apr_quantity'],
            'bus_voltage'       => $row['bus_voltage'],
            'load'              => $row['load'],
            'id_battery_brand'  => $row['id_battery_brand'],
            'id_battery_type'   => $row['id_battery_type'],
            'backup_time'       => $row['backup_time'],
            'backuptime'        => $row['backuptime'],
            'total_battery'     => $row['total_battery'],
            'good_battery'      => $row['good_battery'],
            'degraded_battery'  => $row['degraded_battery'],
            'stolen_battery'    => $row['stolen_battery'],
        ]);
    }

    public function rules(): array
    {
        return [
            'id_site'           => 'required|exists:sites,id',
            'recti_name'        => 'required|string',
            'recti_brand'       => 'required|string',
            'apr_quantity'      => 'required|int',
            'bus_voltage'       => 'required|double',
            'load'              => 'required|double',
            'id_battery_brand'  => 'required|int',
            'id_battery_type'   => 'required|int',
            'backup_time'       => 'required|int',
            'backuptime'        => 'required|int',
            'total_battery'     => 'required|int',
            'good_battery'      => 'required|int',
            'degraded_battery'  => 'required|int',
            'stolen_battery'    => 'required|int',
        ];
    }
}
