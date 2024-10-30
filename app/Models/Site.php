<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = ['site_id', 'site_name', 'address'];

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'area_site');
    }
}


