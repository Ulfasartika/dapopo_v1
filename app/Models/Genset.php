<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Genset extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;
    protected $fillable = [
        'genset_name',
        'genset_brand',
        'capacity',
        'genset_condition',
        'ats',
        'foto_genset',
        'foto_ats',
        'id_site',
        'updated_by'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['genset_name','genset_brand', 'capacity', 'genset_condition', 'ats', 'id_site','foto_genset','foto_ats'])
            ->logOnlyDirty()
            ->useLogName('Genset')
            ->setDescriptionForEvent(fn(string $eventName) => "Genset has been {$eventName}");
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'id_site', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
