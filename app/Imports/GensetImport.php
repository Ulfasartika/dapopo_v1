<?php

namespace App\Imports;

use App\Models\Genset;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use PhpParser\Node\Stmt\Echo_;

class GensetImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $idSite = (string)$row['id_site'];
        $site = Site::where('site_id', $idSite)->first();
        if (!$site) {
            throw new \Exception("Site dengan site_id '{$row['id_site']}' tidak ditemukan.");
        }

        return new Genset([
            'genset_name'       => $row['genset_name'],
            'genset_brand'      => $row['genset_brand'],
            'capacity'          => $row['capacity'],
            'genset_condition'  => $row['genset_condition'],
            'ats'               => $row['ats'],
            'id_site'           => $site->id,
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
        ];
    }
}
