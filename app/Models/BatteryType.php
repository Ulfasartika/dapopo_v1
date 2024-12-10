<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class BatteryType extends Model
{
    use HasFactory;
    use SoftDeletes, LogsActivity;
    protected $fillable = [
        'battery_type',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['battery_type'])
            ->logOnlyDirty()
            ->useLogName('Battery Type')
            ->setDescriptionForEvent(fn(string $eventName) => "Battery type has been {$eventName}");
    }
}
