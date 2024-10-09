<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['equipment_name'];

    public static function createEquipment($equipment)
    {
        return self::create($equipment);
    }

    public static function getAllEquipment()
    {
        return self::all();
    }

    public static function updateEquipment($id, $equipment)
    {
        return self::find($id)->update($equipment);
    }

    public static function deleteEquipment($id)
    {
        return self::destroy($id);
    }

    public function rectifiers()
    {
        return $this->belongsToMany(Rectifier::class, 'equipment_rectifier', 'equipment_id', 'rectifier_id');
    }
}
