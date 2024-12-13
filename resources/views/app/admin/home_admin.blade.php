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
                            <input type="text" id="search" name="search" class="form-control form-control-sm"
                                style="width: 200px;" value="{{ old('search', $search ?? '') }}"
                                placeholder="Cari nama, email, atau role">
                            <button type="submit" class="btn btn-primary btn-sm ml-2">Cari</button>
                        </form>
                    </div>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                        Tambah Pengguna
                    </button>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addModalLabel">Tambah Pengguna</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('adduser') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <!-- Form fields -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

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
                            <th>Dosen Wali</th>
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
                                        <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}"
                                            alt="Profile Photo" style="width: 50px; height: 50px; object-fit: cover;">
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
                                        <a href="{{ route('edituser', $user->id) }}"
                                            class="btn btn-warning btn-sm mr-2">Edit</a>
                                        <form action="{{ route('deleteuser', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data pengguna</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-end mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection