<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MbkmPendaftaran extends Model
{
    use HasFactory;

    protected $table = 'mbkm_pendaftarans';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'email',
        'rencana_pelaksanaan_mbkm',
        'lokasi_mbkm',
        'bukti_penerimaan_mbkm',
        'status',
        'catatan_dosen_wali',
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
