<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        // Create Mahasiswa account
        User::create([
            'name'     => 'Mahasiswa User',
            'username' => 'ifs22013',
            'email'    => 'ifs22013@del.ac.id',
            'nim'      => '12345678',
            'angkatan' => '2022',
            'doswal'   => 'dosen1',
            'password' => Hash::make('12345678'),
            'role'     => 'Mahasiswa',
        ]);

        // Create Admin account
        User::create([
            'name'     => 'Admin System',
            'username' => 'admin123',
            'email'    => 'admin@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Admin',
        ]);

        // Create Koordinator account
        User::create([
            'name'     => 'Iustisia Natalia Simbolon, S.Kom.,M.T',
            'username' => 'iustisia',
            'email'    => 'iustisia.simbolon@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Koordinator',
        ]);

        // Create Dosen Wali accounts
        User::create([
            'name'     => 'Dr. Arlinta Christy Barus S.T., M.InfoTech',
            'username' => 'arlinta',
            'email'    => 'arlinta@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Doswal',
        ]);

        User::create([
            'name'     => 'Iustisia Natalia Simbolon, S.Kom.,M.T',
            'username' => 'iustisia_doswal2',
            'email'    => 'iustisia.simbolon_doswal2@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Doswal',
        ]);

        User::create([
            'name'     => 'Herimanto, S.Kom., M.Kom',
            'username' => 'herimanto',
            'email'    => 'herimanto.pardede@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Doswal',
        ]);

        User::create([
            'name'     => 'Dr. Johannes Harungguan Sianipar, S.T., M.T.',
            'username' => 'johannes',
            'email'    => 'johannes@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Doswal',
        ]);

        User::create([
            'name'     => 'Ranty Deviana Siahaan, S.Kom, M.Eng.',
            'username' => 'ranty',
            'email'    => 'ranty.siahaan@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Doswal',
        ]);

        User::create([
            'name'     => 'Jaya Santoso, S.Si.,M.Si.',
            'username' => 'jaya',
            'email'    => 'jaya@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Doswal',
        ]);

        // Create Kaprodi account
        User::create([
            'name'     => 'Arie Satia Dharma, S.T, M.Kom',
            'username' => 'arie',
            'email'    => 'ariesatia@del.ac.id',
            'nim'      => NULL, // Set as NULL
            'angkatan' => NULL, // Set as NULL
            'doswal'   => NULL, // Set as NULL
            'password' => Hash::make('12345678'),
            'role'     => 'Kaprodi',
        ]);
    }
}
