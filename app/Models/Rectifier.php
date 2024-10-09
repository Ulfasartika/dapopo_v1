<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rectifier extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id_site', 'recti_name', 'recti_brand', 'apr_quantity', 
'bus_voltage','load','id_battery', 'id_bat_type', 'battery_quantity', 'battery_status',
'backup_time', 'id_equipment'];

    public static function createRectifier($rectifier)
    {
        return self::create($rectifier);
    }

    public static function getAllRectifier()
    {
        return self::all();
    }

    public static function updateRectifier($id, $rectifier)
    {
        return self::find($id)->update($rectifier);
    }

    public static function deleteRectifier($id)
    {
        return self::destroy($id);
    }

    public function batteries()
    {
        return $this->belongsTo(Battery::class);
    }

    public function sites()
    {
        return $this->belongsTo(Site::class);
    }

    public function battery_types()
    {
        return $this->belongsTo(BatteryType::class);
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class, 'equipment_rectifier', 'rectifier_id', 'equipment_id');
    }
}
