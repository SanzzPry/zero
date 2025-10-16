<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengalaman_organisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        'nama_organisasi',
        'jabatan',
        'tahun_awal',
        'tahun_akhir',
        'deskripsi',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }
}
