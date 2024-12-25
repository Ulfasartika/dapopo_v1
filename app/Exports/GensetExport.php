<?php
namespace App\Exports;

use App\Models\Genset;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GensetExport implements FromCollection, WithHeadings
{
    /**
     * Mengambil data untuk diekspor.
     */
    public function collection()
    {
        return Genset::with(['site', 'updatedBy'])
            ->get()
            ->map(function ($genset) {
                return [
                    'site_id_name' => $genset->site->site_id . ' - ' . $genset->site->site_name,
                    'genset_name' => $genset->genset_name,
                    'genset_brand' => $genset->genset_brand,
                    'capacity' => $genset->capacity,
                    'genset_condition' => $genset->genset_condition,
                    'ats' => $genset->ats,
                    'updated_at' => $genset->updated_at ? $genset->updated_at->format('Y-m-d H:i:s') : 'N/A',
                    'updated_by' => $genset->updatedBy ? $genset->updatedBy->name : 'N/A',
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
            'Genset Name',
            'Genset Brand',
            'Capacity',
            'Genset Condition',
            'ATS Condition',
            'Last Updated',
            'Updated By',
        ];
    }
}
