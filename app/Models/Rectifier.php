<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rectifier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = 
    ['id_site',
    'recti_name',
    'recti_brand',
    'apr_quantity',
    'bus_voltage',
    'load',
    'id_battery',
    'id_bat_type',
    'battery_quantity',
    'battery_status',
    'backup_time', 
    'id_equipment'];
}
