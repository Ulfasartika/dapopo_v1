<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatteryBrand extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'battery_brand',
        'rectifier_id'
    ];

    public function rectifier()
    {
        return $this->belongsTo(Rectifier::class, 'rectifier_id');
    }
}
