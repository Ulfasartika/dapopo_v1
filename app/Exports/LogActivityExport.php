<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogActivityExport implements FromCollection, WithHeadings
{
    /**
     * Ambil data log aktivitas untuk diekspor.
     */
    public function collection()
    {
        return DB::table('activity_log')
            ->leftJoin('users', 'activity_log.causer_id', '=', 'users.id')
            ->select(
                'activity_log.log_name',
                'activity_log.description',
                'activity_log.subject_type',
                'activity_log.subject_id',
                'users.name as user_name', 
                'activity_log.properties',
                'activity_log.created_at'
            )
            ->get();
    }

    /**
     * Tambahkan header file Excel.
     */
    public function headings(): array
    {
        return [
            'Log Name',
            'Description',
            'Subject Type',
            'Subject ID',
            'User Name', 
            'Properties',
            'Created At',
        ];
    }
}
