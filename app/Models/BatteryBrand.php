<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BatteryBrand extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;
    protected $fillable = [
        'battery_brand',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['battery_brand'])
            ->logOnlyDirty()
            ->useLogName('Battery Brand')
            ->setDescriptionForEvent(fn(string $eventName) => "Battery brand has been {$eventName}");
    }

}
