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
        return Rectifier::with(['site', 'equipments', 'batteries'])
            ->get()
            ->map(function ($rectifier) {
                return [
                    'site_id_name' => $rectifier->site->site_id . ' - ' . $rectifier->site->site_name,
                    'id_pelanggan' => "'" . $rectifier->id_pelanggan, // Menambahkan tanda kutip agar diperlakukan sebagai teks
                    'daya_pln' => $rectifier->daya,
                    'rectifier_name' => $rectifier->recti_name,
                    'rectifier_brand' => $rectifier->recti_brand,
                    'apr_quantity' => $rectifier->apr_quantity,
                    'bus_voltage' => $rectifier->bus_voltage,
                    'load' => $rectifier->load,
                    'battery_brand' => $rectifier->battery_brand,
                    'battery_type' => $rectifier->battery_type,
                    'battery_quantity_status' => $rectifier->batteries->map(function ($battery) {
                        return $battery->battery_quantity . ' (' . $battery->battery_status . ')';
                    })->implode(', '),
                    'backup_time' => $rectifier->backup_time,
                    'equipment_connected' => $rectifier->equipments->pluck('equipment_name')->implode(', '),
                    'image_url' => $rectifier->image ? asset('images/' . $rectifier->image) : 'No Image',
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
            'ID Pelanggan PLN',
            'Daya PLN (kVA)',
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
            'Image URL',
        ];
    }
}
