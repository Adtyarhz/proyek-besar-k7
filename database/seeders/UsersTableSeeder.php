<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun dosen wali tetap
        User::create([
            'id' => 1,
            'username' => 'doswal',
            'role' => 'Doswal',
            'password' => Hash::make('doswal'),
            'remember_token' => Str::random(5),
        ]);

        // Membuat akun editor koordinator
        User::create([
            'username' => 'koordinator',
            'role' => 'koordinator',
            'password' => Hash::make('koordinator'),
            'remember_token' => Str::random(5),
        ]);

        // Membuat akun editor mahasiswa
        User::create([
            'username' => 'mahasiswa',
            'role' => 'mahasiswa',
            'password' => Hash::make('mahasiswa'),
            'remember_token' => Str::random(5),
        ]);

        // Membuat akun editor kaprodi
        User::create([
            'username' => 'kaprodi',
            'role' => 'kaprodi',
            'password' => Hash::make('kaprodi'),
            'remember_token' => Str::random(5),
        ]);

    }
}
