<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'area',
        'user_id'
    ];

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
