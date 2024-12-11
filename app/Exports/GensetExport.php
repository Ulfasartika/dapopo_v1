<?php

namespace App\Exports;

use App\Models\Genset;
use Maatwebsite\Excel\Concerns\FromCollection;

class GensetExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Genset::all();
    }
}
