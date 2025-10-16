<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat_pendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        'pendidikan',
        'jurusan',
        'asal_pendidikan',
        'tahun_awal',
        'tahun_akhir',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }
}
