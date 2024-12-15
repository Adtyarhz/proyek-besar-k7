<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranKP extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_kp';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'email',
        'email_perusahaan',
        'perusahaan',
        'tanggal_awal',
        'tanggal_akhir',
        'lokasi',
        'role_kp',
        'bukti_penerimaan',
        'status_pendaftaran',
        'sks_koordinator',
        'catatan_koordinator_eligible',
        'catatan_kaprodi_eligible',
        'catatan_doswal_eligible',
    ];

    /**
     * Get the user that owns the PendaftaranKP.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
