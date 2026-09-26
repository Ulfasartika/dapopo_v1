<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Area extends Model
{
    use HasFactory, LogsActivity, SoftDeletes;

    protected $fillable = [
        'area',
        'user_id',
        'updated_by'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['area', 'user_id'])
            ->logOnlyDirty()
            ->useLogName('Area')
            ->setDescriptionForEvent(fn(string $eventName) => "Area has been {$eventName}");
    }

    /**
     * Relationship: One Area has many Sites.
     */
    public function sites()
    {
        return $this->hasMany(Site::class, 'area_id');
    }

    /**
     * Relasi many-to-many dengan User.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'area_user', 'area_id', 'user_id');
    }

    public function updatedBy()
    {
    return $this->belongsTo(User::class, 'updated_by');
    }
}
