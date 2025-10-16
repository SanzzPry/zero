<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'namaPerusahaan',
        'jenisPerusahaan',
        'websitePerusahaan',
        'teleponPerusahaan',
        'whatsapp',
        'legalitas',
        'deskripsi',
        'visi',
        'misi',
        'koinPerusahaan',
        'is_berlangganan',
        'img_profile',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function lowongan()
    {
        return $this->hasMany(LowonganPerusahaan::class, 'perusahaan_id');
    }
    public function panggilan()
    {
        return $this->hasOne(DataRequest::class, 'perusahaan_id');
    }
    public function talent()
    {
        return $this->hasMany(TalentHunter::class, 'perusahaan_id');
    }
}
