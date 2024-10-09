<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Battery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['merk_battery'];

    public static function createBattery($battery)
    {
        return self::create($battery);
    }

    public static function getAllBattery()
    {
        return self::all();
    }

    public static function updateBattery($id, $battery)
    {
        return self::find($id)->update($battery);
    }

    public static function deleteBattery($id)
    {
        return self::destroy($id);
    }

    public function rectifiers()
    {
        return $this->hasMany(Rectifier::class);
    }
}
