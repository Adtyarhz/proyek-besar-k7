<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelayakanMBKM extends Model
{
    use HasFactory;

    protected $table = 'kelayakan_mbkm';

    protected $fillable = [
        'user_id',
        'nilai_ipk',
        'total_sks',
        'sks_semester6',
        'nilai_keasramaan',
        'mata_kuliah_tidak_lulus',
        'bukti_sks_ipk',
        'status_kelayakan',
        'catatan_doswal',
        'catatan_kaprodi',
        'catatan_koordinator',
    ];

    /**
     * Relasi dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
