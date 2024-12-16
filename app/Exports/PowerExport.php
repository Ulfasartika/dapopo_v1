<?php
namespace App\Exports;

use App\Models\Rectifier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PowerExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk diekspor.
     */
    public function collection()
    {
        return Rectifier::with(['site', 'equipments', 'batteries', 'kwh', 'gensets'])
            ->get()
            ->map(function ($rectifier) {
                return [
                    'site_id_name' => $rectifier->site->site_id . ' - ' . $rectifier->site->site_name,
                    "'".'id_pelanggan' => $rectifier->kwh->id_pelanggan,
                    'daya' => $rectifier->kwh->daya,
                    'kondisi_kwh' => $rectifier->kwh->kondisi_kwh,
                    'arus_pln' => $rectifier->kwh->arus_pln,
                    'phasa_1' => $rectifier->kwh->phasa_1,
                    'phasa_2' => $rectifier->kwh->phasa_2,
                    'phasa_3' => $rectifier->kwh->phasa_3,
                    'genset_brand' => $rectifier->gensets->pluck('genset_brand')->implode(', ') ?? 'N/A',
                    'capacity' => $rectifier->gensets->pluck('capacity')->implode(', ') ?? 'N/A',
                    'genset_condition' => $rectifier->gensets->pluck('genset_condition')->implode(', ') ?? 'N/A',
                    'ats' => $rectifier->gensets->pluck('ats')->implode(', ') ?? 'N/A',
                    'rectifier_name' => $rectifier->recti_name,
                    'rectifier_brand' => $rectifier->recti_brand,
                    'apr_quantity' => $rectifier->apr_quantity,
                    'bus_voltage' => $rectifier->bus_voltage,
                    'load' => $rectifier->load,
                    'battery_brand' => $rectifier->batterybrand->battery_brand,
                    'battery_type' => $rectifier->batterytype->battery_type,
                    'battery_quantity_status' => $rectifier->batteries->map(function ($battery) {
                        return $battery->battery_quantity . ' (' . $battery->battery_status . ')';
                    })->implode(', '),
                    'backup_time' => $rectifier->backup_time,
                    'equipment_connected' => $rectifier->equipments->pluck('equipment_name')->implode(', '),
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
            'Arus PLN (A)',
            'Phasa 1',
            'Phasa 2',
            'Phasa 3',
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
            'Battery Quantity (Status)',
            'Backup Time (Hours)',
            'Equipment Connected',
        ];
    }
}
