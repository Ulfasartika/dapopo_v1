<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Rectifier extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'id_site',
        'id_pelanggan',
        'daya',
        'recti_name',
        'recti_brand',
        'apr_quantity',
        'bus_voltage',
        'load',
        'battery_brand',
        'battery_type',
        'backup_time',
        'image'
    ];

    /**
     * Relationship: A Rectifier belongs to one Site.
     */
    public function site()
    {
        return $this->belongsTo(Site::class, 'id_site');
    }

    /**
     * Relationship: A Rectifier has many DetailBattery records.
     */
    public function batteries()
    {
        return $this->hasMany(DetailBattery::class, 'rectifier_id');
    }

    /**
     * Relationship: Many Rectifiers have many Equipments.
     */
    public function equipments()
    {
        return $this->belongsToMany(Equipment::class, 'equipment_rectifier', 'rectifier_id', 'equipment_id')
                    ->withTimestamps();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['daya', 'load', 'image', 'id_site', 'recti_name', 'backup_time', 'bus_voltage', 'recti_brand', 'apr_quantity', 'battery_type', 'id_pelanggan', 'battery_brand'])
            ->logOnlyDirty()
            ->useLogName('rectifier')
            ->setDescriptionForEvent(fn(string $eventName) => "Rectifier has been {$eventName}");
    }
    
}
