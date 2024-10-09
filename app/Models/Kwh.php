<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kwh extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang bisa diisi secara massal
    protected $fillable = ['site_id', 'id_pelanggan', 'daya'];

    // Relasi dengan model Site
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
    
    // Mengambil semua data Kwh
    public static function getAllKwh()
    {
        return self::all();
    }

    // Membuat data Kwh baru
    public static function createKwh(array $kwhData)
    {
        return self::create($kwhData);
    }

    // Memperbarui data Kwh
    public static function updateKwh($id, array $kwhData)
    {
        $kwh = self::findOrFail($id);
        return $kwh->update($kwhData);
    }

    // Menghapus data Kwh
    public static function deleteKwh($id)
    {
        return self::destroy($id);
    }
}
