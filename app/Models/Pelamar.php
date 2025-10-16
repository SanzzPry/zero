<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_pelamar',
        'deskripsi_diri',
        'alamat',
        'tanggal_lahir',
        'gender',
        'teleponPelamar',
        'divisi',
        'mulai_pelatihan',
        'selesai_pelatihan',
        'img_profile',
        'kategori',
        'alasan_freeze',
        'gaji_minimal',
        'gaji_maksimal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function riwayatPendidikans()
    {
        return $this->hasMany(riwayat_pendidikan::class, 'pelamar_id');
    }

    public function pengalamanKerjas()
    {
        return $this->hasMany(pengalaman_kerja::class, 'pelamar_id');
    }

    public function pengalamanOrganisasis()
    {
        return $this->hasMany(pengalaman_organisasi::class, 'pelamar_id');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class, 'pelamar_id');
    }

    public function socialMediaPelamar()
    {
        return $this->hasOne(social_media_pelamar::class, 'pelamar_id');
    }
}
