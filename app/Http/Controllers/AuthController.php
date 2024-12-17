<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\StudentCount;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username', 'remember'));
    }

    public function showRegisterForm()
    {
        // Ambil semua dosen yang memiliki role 'doswal'
        $dosenWali = User::where('role', 'doswal')->get();

        // Ambil tahun dari tabel StudentCount
        $years = StudentCount::select('year')->distinct()->orderBy('year', 'asc')->get();

        return view('auth.register', compact('dosenWali', 'years'));
    }


    public function register(Request $request)
    {
        $request->merge(['password_confirmation' => $request->input('confirmPassword')]);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'nim' => 'required|string|max:20|unique:users',
            'angkatan' => 'required|string|max:10',
            'doswal' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $role = 'Mahasiswa';

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'nim' => $validatedData['nim'],
            'angkatan' => $validatedData['angkatan'],
            'doswal' => $validatedData['doswal'],
            'password' => bcrypt($validatedData['password']),
            'role' => $role,
        ]);

        Auth::login($user);

        return redirect('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
