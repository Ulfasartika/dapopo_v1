<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentRectifier extends Model
{
    use HasFactory;
    protected $table = 'equipment_rectifier';

    protected $fillable = [
        'rectifier_id',
        'equipment_id'
    ];
}
