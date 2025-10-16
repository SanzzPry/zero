<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengalaman_kerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        'posisi_pekerjaan',
        'jabatan_pekerjaan',
        'nama_perusahaan',
        'tahun_awal',
        'tahun_akhir',
        'deskripsi',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }
}
