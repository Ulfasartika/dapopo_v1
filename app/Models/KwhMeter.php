<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KwhMeter extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id_pelanggan',
        'daya',
        'kondisi_kwh',
        'arus_pln',
        'phasa_1',
        'phasa_2',
        'phasa_3',
        'foto_kwh',
        'id_site'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
