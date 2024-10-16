<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rectifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_site',
        'id_pelanggan',
        'daya',
        'recti_name',
        'recti_brand',
        'apr_quantity',
        'bus_voltage',
        'load',
        'battery_brand',
        'battery_type',
        'battery_quantity',
        'battery_status',
        'backup_time',
        'id_equipment',
    ];

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'recti_site');
    }

    public function equipments()
    {
        return $this->belongsToMany(Equipment::class, 'equipment_rectifier');
    }
}
