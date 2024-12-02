<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genset extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'genset_brand',
        'capacity',
        'genset_condition',
        'ats',
        'foto_genset',
        'foto_ats',
        'id_site'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'id_site', 'id');
    }

}
