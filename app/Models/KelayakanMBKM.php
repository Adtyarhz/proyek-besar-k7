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
        'nama',
        'nim',
        'email',
        'rencana_pelaksanaan_mbkm',
        'lokasi_mbkm',
        'bukti_sks_ipk',
        'status_kelayakan',
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
