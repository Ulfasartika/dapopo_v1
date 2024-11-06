<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Battery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rectifier_batteries';
    protected $fillable = [
        'rectifier_id',      
        'battery_quantity',
        'battery_status',
    ];

    public function rectifier()
    {
        return $this->belongsTo(Rectifier::class, 'rectifier_id');
    }
}
