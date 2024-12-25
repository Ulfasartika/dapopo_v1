<?php
namespace App\Exports;

use App\Models\KwhMeter;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KwhExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk diekspor.
     */
    public function collection()
    {
        return KwhMeter::with(['site', 'updatedBy'])
            ->get()
            ->map(function ($kwh) {
                return [
                    'site_id_name' => $kwh->site->site_id . ' - ' . $kwh->site->site_name,
                    "'".'id_pelanggan' => $kwh->id_pelanggan,
                    'daya' => $kwh->daya,
                    'kondisi_kwh' => $kwh->kondisi_kwh,
                    'kondisi_segel' => $kwh->kondisi_segel,
                    'arus_r' => $kwh->arus_r,
                    'arus_s' => $kwh->arus_s,
                    'arus_t' => $kwh->arus_t,
                    'phasa_r' => $kwh->phasa_r,
                    'phasa_s' => $kwh->phasa_s,
                    'phasa_t' => $kwh->phasa_t,
                    'updated_at' => $kwh->updated_at ? $kwh->updated_at->format('Y-m-d H:i:s') : 'N/A',
                    'updated_by' => $kwh->updatedBy ? $kwh->updatedBy->name : 'N/A',
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
            'Last Updated',
            'Updated By',
        ];
    }
}
