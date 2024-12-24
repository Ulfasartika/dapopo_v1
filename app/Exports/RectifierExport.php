<?php
namespace App\Exports;

use App\Models\Rectifier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RectifierExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk diekspor.
     */
    public function collection()
    {
        return Rectifier::with(['site', 'equipments', 'kwh', 'gensets', 'updatedBy'])
            ->get()
            ->map(function ($rectifier) {
                return [
                    'site_id_name' => $rectifier->site->site_id . ' - ' . $rectifier->site->site_name,
                    "'".'id_pelanggan' => $rectifier->kwh->id_pelanggan,
                    'daya' => $rectifier->kwh->daya,
                    'kondisi_kwh' => $rectifier->kwh->kondisi_kwh,
                    'kondisi_segel' => $rectifier->kwh->kondisi_segel,
                    'arus_r' => $rectifier->kwh->arus_r,
                    'arus_s' => $rectifier->kwh->arus_s,
                    'arus_t' => $rectifier->kwh->arus_t,
                    'phasa_r' => $rectifier->kwh->phasa_r,
                    'phasa_s' => $rectifier->kwh->phasa_s,
                    'phasa_t' => $rectifier->kwh->phasa_t,
                    'genset_name' => $rectifier->gensets->pluck('genset_name')->implode(', ') ?? 'N/A',
                    'genset_brand' => $rectifier->gensets->pluck('genset_brand')->implode(', ') ?? 'N/A',
                    'capacity' => $rectifier->gensets->pluck('capacity')->implode(', ') ?? 'N/A',
                    'genset_condition' => $rectifier->gensets->pluck('genset_condition')->implode(', ') ?? 'N/A',
                    'ats' => $rectifier->gensets->pluck('ats')->implode(', ') ?? 'N/A',
                    'rectifier_name' => $rectifier->recti_name,
                    'rectifier_brand' => $rectifier->recti_brand,
                    'apr_quantity' => $rectifier->apr_quantity,
                    'bus_voltage' => $rectifier->bus_voltage,
                    'load' => $rectifier->load,
                    'id_battery_brand' => $rectifier->batterybrand->battery_brand,
                    'id_battery_type' => $rectifier->batterytype->battery_type,
                    'total_battery' => $rectifier->total_battery,
                    'good_battery' => $rectifier->good_battery,
                    'degraded_battery' => $rectifier->degraded_battery,
                    'stolen_battery' => $rectifier->stolen_battery,
                    'backup_time' => $rectifier->backup_time,
                    'equipment_connected' => $rectifier->equipments->pluck('equipment_name')->implode(', '),
                    'updated_at' => $rectifier->updated_at ? $rectifier->updated_at->format('Y-m-d H:i:s') : 'N/A',
                    'updated_by' => $rectifier->updatedBy ? $rectifier->updatedBy->name : 'N/A',
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
            'ID Pelanggan',
            'Daya PLN (kVA)',
            'Kondisi KWH Meter',
            'Kondisi Segel',
            'Arus R (A)',
            'Arus S (A)',
            'Arus T (A)',
            'Phasa R',
            'Phasa S',
            'Phasa T',
            'Genset Name',
            'Genset Brand',
            'Capacity',
            'Genset Condition',
            'ATS Condition',
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
