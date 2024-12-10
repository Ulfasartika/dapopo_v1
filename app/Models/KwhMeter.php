<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class KwhMeter extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'id_pelanggan',
        'daya',
        'kondisi_kwh',
        'arus_pln',
        'phasa_1',
        'phasa_2',
        'phasa_3',
        'foto_kwh',
        'id_site'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class, 'id_site', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['id_pelanggan', 'daya', 'kondisi_kwh', 'arus_pln', 'phasa_1', 'phasa_2', 'phasa_3', 'id_site', 'foto_kwh'])
            ->logOnlyDirty()
            ->useLogName('KWh Meter')
            ->setDescriptionForEvent(fn(string $eventName) => "KWh Meter has been {$eventName}");
    }
}
