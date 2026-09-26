<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Site;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiteImport implements ToModel
{
    private $isFirstRow = true;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($this->isFirstRow) {
            $this->isFirstRow = false; 
            return null;
        }
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
