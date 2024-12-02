<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_id',
        'site_name',
        'area_id',
        'address'
    ];

    /**
     * Relationship: A Site belongs to one Area.
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function kwh()
    {
        return $this->hasOne(KwhMeter::class, 'id_site','id');
    }

    public function genset()
    {
        return $this->hasMany(Genset::class, 'id_site', 'id');
    }
}
