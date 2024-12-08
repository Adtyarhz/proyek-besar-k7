<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'username',
        'email',
        'nim',
        'angkatan',
        'doswal',
        'password',
        'role',
        'profile_photo', // Add this line
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function mbkmPendaftaran()
{
    return $this->hasOne(MbkmPendaftaran::class);
}
}
