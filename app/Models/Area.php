<?php

// app/Models/Area.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['area'];

    public function sites()
    {
        return $this->belongsToMany(Site::class, 'area_site');
    }
}
