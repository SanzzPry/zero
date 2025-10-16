<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HargaPembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jumlah_koin',
        'harga',
    ];
}
