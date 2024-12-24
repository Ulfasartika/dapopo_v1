<?php

namespace App\Imports;

use App\Models\Genset;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;



class GensetImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Genset([
            'genset_name'       => $row['genset_name'],
            'genset_brand'      => $row['genset_brand'],
            'capacity'          => $row['capacity'],
            'genset_condition'  => $row['genset_condition'],
            'ats'               => $row['ats'],
            'id_site'           => $row['id_site'],
        ]);
    }

    public function rules(): array
    {
        return [
            'genset_name'       => 'required|string',
            'genset_brand'      => 'required|string',
            'capacity'          => 'required|integer',
            'genset_condition'  => 'required|string',
            'ats'               => 'required|string',
            'id_site'           => 'required|exists:sites,id',
        ];
    }
}
