@extends('layouts.admin')

@section('title', 'Home Admin')

@section('content')
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Kelola Pengguna</span>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="search-container d-flex align-items-center">
                        <form action="{{ route('kelola') }}" method="GET" class="d-flex">
                            <label for="search" class="mr-2">Search:</label>
                            <input type="text" id="search" name="search" class="form-control form-control-sm" style="width: 200px;" value="{{ old('search', $search ?? '') }}" placeholder="Cari nama, email, atau role">
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Cari</button>
                        </form>
                    </div>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        Tambah Pengguna
                    </button>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah Pengguna</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('adduser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group mb-3">
                                         <label for="password">Password</label>
                                         <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nim">NIM</label>
                                        <input type="text" class="form-control" id="nim" name="nim" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="angkatan">Angkatan</label>
                                        <input type="text" class="form-control" id="angkatan" name="angkatan" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="doswal">Dosen Wali</label>
                                        <input type="text" class="form-control" id="doswal" name="doswal">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="">Pilih Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="editor">Editor</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="kaprodi">Kaprodi</option>
                                            <option value="doswal">Doswal</option>
                                            <option value="koordinator">Koordinator</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="profile_photo">Foto Profil</label>
                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>NIM</th>
                            <th>Angkatan</th>
                            <th>Doswal</th>
                            <th>Role</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile Photo" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nim }}</td>
                                <td>{{ $user->angkatan }}</td>
                                <td>{{ $user->doswal }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <div class="d-flex">
                                        <button type="button" class="btn btn-warning btn-sm mr-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}">Edit</button>

                                        <form action="{{ route('deleteuser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('edituser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nim">NIM</label>
                                                    <input type="text" class="form-control" id="nim" name="nim" value="{{ $user->nim }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="angkatan">Angkatan</label>
                                                    <input type="text" class="form-control" id="angkatan" name="angkatan" value="{{ $user->angkatan }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="doswal">Dosen Wali</label>
                                                    <input type="text" class="form-control" id="doswal" name="doswal" value="{{ $user->doswal }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <select class="form-control" id="role" name="role" required>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                
                                                <option value="Mahasiswa" {{ $user->role == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                                <option value="Kaprodi" {{ $user->role == 'Kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                                                <option value="Doswal" {{ $user->role == 'Doswal' ? 'selected' : '' }}>Doswal</option>
                                                <option value="Koordinator" {{ $user->role == 'Koordinator' ? 'selected' : '' }}>Koordinator</option>  </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data pengguna</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-3">
    <nav>
        <ul class="pagination">
            @if ($users->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">« Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" rel="prev">« Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="page-item {{ $users->currentPage() == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($users->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" rel="next">Next »</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next »</span>
                </li>
            @endif
        </ul>
    </nav>
</div>


            </div>
        </div>
    </div>
</div>
@endsection
