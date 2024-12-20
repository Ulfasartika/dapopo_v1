<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Equipment extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    protected $table = 'equipments';
    protected $fillable = [
        'equipment_name',
        'updated_by'
    ];

    public function rectifiers()
    {
        return $this->belongsToMany(Rectifier::class, 'equipment_rectifier', 'rectifier_id', 'equipment_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['equipment_name'])
            ->logOnlyDirty()
            ->useLogName('Equipment')
            ->setDescriptionForEvent(fn(string $eventName) => "Equipment has been {$eventName}");
    }

    public function updatedBy()
    {
    return $this->belongsTo(User::class, 'updated_by');
    }

}
