<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;

class SiteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $area = Area::where('area', $row[4])->first();
        $area_id = $area ? $area->id : 1;
        return new Site([
            'site_id' => $row[1],
            'site_name' => $row[2],
            'area_id' => $area_id,
            'address' => $row[7],
        ]);
    }
}
