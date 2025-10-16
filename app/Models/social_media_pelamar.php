<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class social_media_pelamar extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        'instagram',
        'linkedin',
        'website',
        'twitter',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }
}
