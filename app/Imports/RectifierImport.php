<?php

namespace App\Imports;

use App\Models\Rectifier;
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
        return new Rectifier([
            'id_site'           => $row['id_site'],
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
