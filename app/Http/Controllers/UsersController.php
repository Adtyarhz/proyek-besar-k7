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
        $users = User::simplePaginate(10);

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
        \Log::info('Store method dipanggil');
        \Log::info('Data yang diterima: ', $request->all());
    
        // Validasi input dengan role dalam lowercase
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'nim' => 'required|string|unique:users,nim',
            'angkatan' => 'required|integer',
            'doswal' => 'nullable|string|max:255',
            'password' => 'required|min:6',
            'role' => 'required|in:editor,admin,mahasiswa,kaprodi,doswal,koordinator',
            'profile_photo' => 'nullable|image|max:2048', // Max 2MB
        ]);
    
        $profilePhoto = null;
    
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $profilePhoto = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('profile_photos', $profilePhoto, 'public');
        }
    
        // Simpan data pengguna ke database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'nim' => $request->nim,
            'angkatan' => $request->angkatan,
            'doswal' => $request->doswal,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'profile_photo' => $profilePhoto,
        ]);
    
        \Log::info('Pengguna berhasil ditambahkan');
    
        return redirect()->route('kelola')->with('success', 'Pengguna berhasil ditambahkan.');
    }
    
    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('kelola')->with('error', 'Pengguna tidak ditemukan.');
        }

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'nim' => 'required|string|unique:users,nim,' . $id,
            'angkatan' => 'required|integer',
            'doswal' => 'nullable|string|max:255',
            'role' => 'required|in:editor,admin,Mahasiswa,Kaprodi,Doswal,Koordinator',
            'profile_photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Delete old profile photo if it exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete('profile_photos/' . $user->profile_photo);
            }

            // Store new profile photo
            $file->storeAs('profile_photos', $filename, 'public');
            $user->profile_photo = $filename;
        }

        // Update user information
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

        // Delete profile photo if it exists
        if ($user->profile_photo) {
            Storage::disk('public')->delete('profile_photos/' . $user->profile_photo);
        }

        // Delete user
        $user->delete();

        return redirect()->route('kelola')->with('success', 'Pengguna berhasil dihapus.');
    }
}
