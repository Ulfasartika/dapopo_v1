<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['site_id', 'site_name','area', 'address'];
    public function rectifiers()
    {
        return $this->belongsToMany(Rectifier::class, 'recti_site');
    }
}

