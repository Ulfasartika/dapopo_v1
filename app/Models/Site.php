<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;



class Site extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $fillable = [
        'site_id',
        'site_name',
        'area_id',
        'address',
        'updated_by'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['site_id', 'site_name', 'area_id', 'address'])
            ->logOnlyDirty()
            ->useLogName('Site')
            ->setDescriptionForEvent(fn(string $eventName) => "Site has been {$eventName}");
    }

    /**
     * Relationship: A Site belongs to one Area.
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function kwh()
    {
        return $this->hasOne(KwhMeter::class, 'id_site','id');
    }

    public function gensets()
    {
        return $this->hasMany(Genset::class, 'id_site', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
