<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BatteryType extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'battery_type',
        'rectifier_id'
    ];

    public function rectifier()
    {
        return $this->belongsTo(Rectifier::class, 'rectifier_id');
    }
}
