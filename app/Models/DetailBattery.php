<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailBattery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'detail_battery';
    protected $fillable = [
        'battery_quantity',
        'battery_status',
        'rectifier_id'
    ];

    public function rectifier()
    {
        return $this->belongsTo(Rectifier::class, 'rectifier_id');
    }
}
