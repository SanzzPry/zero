<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelamar_id',
        'skill',
        'experience_level',
    ];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class, 'pelamar_id');
    }
}
