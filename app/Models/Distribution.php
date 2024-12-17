<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi
    protected $fillable = [
        'type',       // 'KP' atau 'MBKM'
        'region',     // Jawa, Sumatera, Lainnya
        'students',   // Jumlah mahasiswa
        'year',       // Tahun kegiatan
    ];
}
