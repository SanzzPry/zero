<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'img_profile',
        'province_id',
        'city_id',
        'district_id',
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
        'detail_alamat',
        'kode_pos',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
