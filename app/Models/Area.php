<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Area extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'area',
        'user_id'
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
