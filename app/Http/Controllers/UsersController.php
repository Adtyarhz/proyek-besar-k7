<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            case 'Admin':
                return redirect()->route('home.admin');
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

    public function adminHome()
    {
        $user = Auth::user();
        if ($user->role !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        // Fetch all users (with optional pagination)
        $users = User::paginate(10);

        return view('app.admin.home_admin', compact('users'));
    }


    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mengambil data dengan pencarian
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%")
                ->orWhere('angkatan', 'like', "%{$search}%")
                ->orWhere('doswal', 'like', "%{$search}%");
        })->paginate(10); // Pagination

        return view('app.admin.home_admin', compact('users', 'search'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'nim' => 'required|string|unique:users,nim',
            'angkatan' => 'required|integer',
            'doswal' => 'nullable|string|max:255',
            'password' => 'required|min:6',
            'role' => 'required|in:editor,admin,Mahasiswa,Kaprodi,Doswal,Koordinator',
        ]);

        // Simpan data pengguna ke database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'doswal' => $request->doswal,
            'password' => Hash::make($request->password), // Hashing password
            'role' => $request->role,
            'profile_photo' => null,
        ]);

        return redirect()->route('kelola')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('kelola')->with('error', 'Pengguna tidak ditemukan.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'nim' => 'required|string|unique:users,nim,' . $id,
            'angkatan' => 'required|integer',
            'doswal' => 'nullable|string|max:255',
            'role' => 'required|in:editor,admin,Mahasiswa,Kaprodi,Doswal,Koordinator',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->nim = $request->nim;
        $user->angkatan = $request->angkatan;
        $user->doswal = $request->doswal;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('kelola')->with('success', 'Pengguna berhasil diubah.');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('kelola')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Hapus file foto profil menggunakan Storage jika ada
        if ($user->profile_photo) {
            Storage::disk('public')->delete('profile_photos/' . $user->profile_photo);
        }

        // Hapus data pengguna dari database
        $user->delete();

        return redirect()->route('kelola')->with('success', 'Pengguna berhasil dihapus.');
    }

}
