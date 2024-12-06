<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function home()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'Mahasiswa':
                return redirect()->route('home.mahasiswa');
            case 'Kaprodi':
                return redirect()->route('home.kaprodi');
            case 'Doswal':
                return redirect()->route('home.doswal');
            case 'Koordinator':
                return redirect()->route('home.koordinator');
            default:
                abort(403, 'Unauthorized action.');
        }
    }

    public function mahasiswaHome()
    {
        $user = Auth::user();
        if ($user->role !== 'Mahasiswa') {
            abort(403, 'Unauthorized action.');
        }
        return view('app.mahasiswa.home_mahasiswa');
    }

    public function kaprodiHome()
    {
        $user = Auth::user();
        if ($user->role !== 'Kaprodi') {
            abort(403, 'Unauthorized action.');
        }
        return view('app.kaprodi.home_kaprodi');
    }

    public function doswalHome()
    {
        $user = Auth::user();
        if ($user->role !== 'Doswal') {
            abort(403, 'Unauthorized action.');
        }
        return view('app.doswal.home_doswal');
    }

    public function koordinatorHome()
    {
        $user = Auth::user();
        if ($user->role !== 'Koordinator') {
            abort(403, 'Unauthorized action.');
        }
        return view('app.koordinator.home_koordinator');
    }
}
