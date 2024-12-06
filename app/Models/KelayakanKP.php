<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelayakanKP extends Model
{
    use HasFactory;

    protected $table = 'kelayakan_kps';

    protected $fillable = [
        'user_id',
        'nilai_ipk',
        'total_sks',
        'sks_semester6',
        'mata_kuliah_tidak_lulus',
        'bukti_sks_ipk',
        'status_kelayakan',
        'catatan_doswal',
        'catatan_kaprodi',
        'catatan_koordinator',
    ];

    /**
     * Get the user that owns the KelayakanKP.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
