<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatanTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_referensi',
        'dari',
        'sumber_dana',
        'jenis',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
