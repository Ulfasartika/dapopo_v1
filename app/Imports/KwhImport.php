<?php

namespace App\Imports;

use App\Models\KwhMeter;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KwhImport implements ToModel, WithHeadingRow, WithValidation
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

        return new KwhMeter([
            'id_pelanggan'      => $row['id_pelanggan'],
            'daya'              => $row['daya'],
            'kondisi_kwh'       => $row['kondisi_kwh'],
            'kondisi_segel'     => $row['kondisi_segel'],
            'arus_t'            => $row['arus_t'],
            'arus_s'            => $row['arus_s'],
            'arus_t'            => $row['arus_t'],
            'phasa_r'           => $row['phasa_r'],
            'phasa_s'           => $row['phasa_s'],
            'phasa_t'           => $row['phasa_t'],
            'id_site'           => $site->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'id_pelanggan'      => 'required|string',
            'daya'              => 'required|integer',
            'kondisi_kwh'       => 'required|string',
            'kondisi_segel'     => 'required|string',
            'arus_r'            => 'required|int',
            'arus_s'            => 'required|int',
            'arus_t'            => 'required|int',
            'phasa_r'           => 'required|int',
            'phasa_s'           => 'required|int',
            'phasa_t'           => 'required|int',
            'id_site'           => 'required|exists:sites,id',
        ];
    }
}
