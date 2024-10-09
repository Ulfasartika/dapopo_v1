<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatteryType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['battery_type'];

    public static function createBatteryType($battery_type)
    {
        return self::create($battery_type);
    }

    public static function getAllBatteryType()
    {
        return self::all();
    }

    public static function updateBatteryType($id, $battery_type)
    {
        return self::find($id)->update($battery_type);
    }

    public static function deleteBatteryType($id)
    {
        return self::destroy($id);
    }

    public function rectifiers()
    {
        return $this->hasMany(Rectifier::class);
    }

}

