<?php
namespace App\Exports;

use App\Models\Rectifier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RectifierOnlyExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk diekspor.
     */
    public function collection()
    {
        return Rectifier::with(['site', 'equipments','updatedBy'])
            ->get()
            ->map(function ($rectifiers) {
                return [
                    'site_id_name' => $rectifiers->site->site_id . ' - ' . $rectifiers->site->site_name,
                    'rectifier_name' => $rectifiers->recti_name,
                    'rectifier_brand' => $rectifiers->recti_brand,
                    'apr_quantity' => $rectifiers->apr_quantity,
                    'bus_voltage' => $rectifiers->bus_voltage,
                    'load' => $rectifiers->load,
                    'id_battery_brand' => $rectifiers->batterybrand->battery_brand,
                    'id_battery_type' => $rectifiers->batterytype->battery_type,
                    'total_battery' => $rectifiers->total_battery,
                    'good_battery' => $rectifiers->good_battery,
                    'degraded_battery' => $rectifiers->degraded_battery,
                    'stolen_battery' => $rectifiers->stolen_battery,
                    'backup_time' => $rectifiers->backup_time,
                    'equipment_connected' => $rectifiers->equipments->pluck('equipment_name')->implode(', '),
                    'updated_at' => $rectifiers->updated_at ? $rectifiers->updated_at->format('Y-m-d H:i:s') : 'N/A',
                    'updated_by' => $rectifiers->updatedBy ? $rectifiers->updatedBy->name : 'N/A',
                ];
            });
    }
        

    /**
     * Menentukan kolom heading untuk file Excel.
     */
    public function headings(): array
    {
        return [
            'Site ID - Site Name',
            'Rectifier Name',
            'Rectifier Brand',
            'APR Quantity',
            'Bus Voltage (V)',
            'Load (A)',
            'Battery Brand',
            'Battery Type',
            'Total Battery',
            'Good Battery',
            'Degraded Battery',
            'Stolen Battery',
            'Backup Time (Hours)',
            'Equipment Connected',
            'Last Updated',
            'Updated By',
        ];
    }
}
