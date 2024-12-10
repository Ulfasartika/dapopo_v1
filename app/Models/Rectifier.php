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
    use SoftDeletes, LogsActivity;

    protected $fillable = [
        'id_site',
        'recti_name',
        'recti_brand',
        'apr_quantity',
        'bus_voltage',
        'load',
        'total_battery',
        'id_battery_brand',
        'id_battery_type',
        'backup_time',
        'image'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id_site','recti_name','recti_brand','apr_quantity','bus_voltage','load'
            ,'total_battery','id_battery_brand','id_battery_type','backup_time','image'])
            ->logOnlyDirty()
            ->useLogName('Rectifier')
            ->setDescriptionForEvent(fn(string $eventName) => "Rectifier has been {$eventName}");
    }

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

    public function batterybrand()
    {
        return $this->belongsTo(BatteryBrand::class, 'id_battery_brand');
    }

    public function batterytype()
    {
        return $this->belongsTo(BatteryType::class, 'id_battery_type');
    }

    public function kwh()
    {
        return $this->hasOneThrough(KwhMeter::class, Site::class, 'id', 'id_site', 'id_site', 'id');
    }

    public function gensets()
    {
        return $this->hasManyThrough(Genset::class, Site::class, 'id', 'id_site', 'id_site', 'id');
    }
    
    
}
