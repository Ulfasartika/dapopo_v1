<?php

namespace App\Imports;

use App\Models\KwhMeter;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KwhImport implements ToModel, WithHeadingRow
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
            'arus_r'            => $row['arus_r'],
            'arus_s'            => $row['arus_s'],
            'arus_t'            => $row['arus_t'],
            'phasa_r'           => $row['phasa_r'],
            'phasa_s'           => $row['phasa_s'],
            'phasa_t'           => $row['phasa_t'],
            'id_site'           => $site->id,
        ]);
    }
}
