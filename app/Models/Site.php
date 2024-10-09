<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['site_id', 'site_name', 'address'];

    public static function createSite($site)
    {
        return self::create($site);
    }

    public static function getAllSite()
    {
        return self::all();
    }

    public static function updateSite($id, $site)
    {
        return self::find($id)->update($site);
    }

    public static function deleteSite($id)
    {
        return self::destroy($id);
    }

    public function kwhs()
    {
        return $this->hasMany(Kwh::class);
    }

    public function rectifiers()
    {
        return $this->hasMany(Rectifier::class);
    }
}

