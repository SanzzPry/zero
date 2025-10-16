<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganPerusahaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'perusahaan_id',
        'nama',
        'slug',
        'jenis',
        'rekomendasi',
        'gaji_awal',
        'gaji_akhir',
        'label_gaji',
        'deskripsi',
        'alamat',
        'kategori',
        'batas_lamaran',
        'syarat_pekerjaan',
        'tanggung_jawab',
        'benefit',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
