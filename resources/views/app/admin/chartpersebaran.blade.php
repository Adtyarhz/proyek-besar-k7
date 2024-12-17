@extends('layouts.admin')

@section('title', 'Kelola Chart Persebaran')

@section('content')
<div class="container">
  <h1>Kelola Chart Persebaran</h1>

  {{-- Form Tambah Data --}}
  <h2>Tambah Data Persebaran</h2>
  <form action="{{ route('distributionsadd') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="type" class="form-label">Jenis</label>
      <select name="type" id="type" class="form-select" required>
        <option value="KP">KP</option>
        <option value="MBKM">MBKM</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="region" class="form-label">Wilayah</label>
      <select name="region" id="region" class="form-select" required>
        <option value="Jawa">Jawa</option>
        <option value="Sumatera">Sumatera</option>
        <option value="Lainnya">Lainnya</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="students" class="form-label">Jumlah Mahasiswa</label>
      <input type="number" name="students" id="students" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="year" class="form-label">Tahun</label>
      <input type="number" name="year" id="year" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
  </form>

  <hr>

  {{-- Tabel Data Persebaran --}}
  <h2>Daftar Data Persebaran</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Jenis</th>
        <th>Wilayah</th>
        <th>Jumlah Mahasiswa</th>
        <th>Tahun</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($distributions as $index => $distribution)
      <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $distribution->type }}</td>
      <td>{{ $distribution->region }}</td>
      <td>{{ $distribution->students }}</td>
      <td>{{ $distribution->year }}</td>
      <td>
        {{-- Tombol Edit --}}
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#editModal{{ $distribution->id }}">
        Edit
        </button>

        {{-- Tombol Hapus --}}
        <form action="{{ route('distributiondelete', $distribution->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm"
          onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
        </form>
      </td>
      </tr>

      {{-- Modal Edit --}}
      <div class="modal fade" id="editModal{{ $distribution->id }}" tabindex="-1"
      aria-labelledby="editModalLabel{{ $distribution->id }}" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel{{ $distribution->id }}">Edit Data Persebaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('distributionsedit', $distribution->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">
          <div class="mb-3">
            <label for="type" class="form-label">Jenis</label>
            <select name="type" id="type" class="form-select" required>
            <option value="KP" {{ $distribution->type == 'KP' ? 'selected' : '' }}>KP</option>
            <option value="MBKM" {{ $distribution->type == 'MBKM' ? 'selected' : '' }}>MBKM</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="region" class="form-label">Wilayah</label>
            <select name="region" id="region" class="form-select" required>
            <option value="Jawa" {{ $distribution->region == 'Jawa' ? 'selected' : '' }}>Jawa</option>
            <option value="Sumatera" {{ $distribution->region == 'Sumatera' ? 'selected' : '' }}>Sumatera</option>
            <option value="Lainnya" {{ $distribution->region == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="students" class="form-label">Jumlah Mahasiswa</label>
            <input type="number" name="students" id="students" class="form-control"
            value="{{ $distribution->students }}" required>
          </div>

          <div class="mb-3">
            <label for="year" class="form-label">Tahun</label>
            <input type="number" name="year" id="year" class="form-control" value="{{ $distribution->year }}"
            required>
          </div>
          </div>
          <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
        </form>
        </div>
      </div>
      </div>
    @endforeach
    </tbody>
  </table>
</div>
@endsection