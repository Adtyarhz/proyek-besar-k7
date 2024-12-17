@extends('layouts.admin')

@section('title', 'Kelola Chart Persebaran')

@section('content')
<div class="container">

  <br>

  {{-- Tabel Data Persebaran --}}
  <h3>Daftar Data Persebaran</h3>

  {{-- Dropdown Pemilihan Tahun --}}
  @php
  $years = $distributions->pluck('year')->unique()->sort(); // Daftar tahun unik
  $selectedYear = request('year') ?? $years->first(); // Tahun dipilih dari query string atau default tahun pertama
@endphp

  <div class="mb-3">
    <form method="GET" action="{{ url()->current() }}">
      <label for="year" class="form-label">Pilih Tahun</label>
      <select name="year" id="year" class="form-select" onchange="this.form.submit()">
        @foreach ($years as $year)
      <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
        {{ $year }}
      </option>
    @endforeach
      </select>
    </form>
  </div>

  {{-- Filter data berdasarkan tahun --}}
  @php
  $filteredData = $distributions->where('year', $selectedYear); // Filter data sesuai tahun
  $kpDistributions = $filteredData->where('type', 'KP'); // Data KP
  $mbkmDistributions = $filteredData->where('type', 'MBKM'); // Data MBKM
@endphp

  @if ($filteredData->isEmpty())
    <p>Tidak ada data untuk tahun {{ $selectedYear }}.</p>
  @else
    <div class="row">

    {{-- Tabel KP --}}
    <div class="col-md-6">
      <h5>KP (Kerja Praktik)</h5>
      <table class="table table-bordered">
      <thead>
        <tr>
        <th>No</th>
        <th>Wilayah</th>
        <th>Jumlah Mahasiswa</th>
        <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php  $kpIndex = 1; @endphp
        @foreach ($kpDistributions as $distribution)
      <tr>
      <td>{{ $kpIndex++ }}</td>
      <td>{{ $distribution->region }}</td>
      <td>{{ $distribution->students }}</td>
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
      <div class="modal fade" id="editModal{{ $distribution->id }}" tabindex="-1" aria-labelledby="editModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Persebaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('distributionsedit', $distribution->id) }}" method="POST">
        @csrf
        @method('PUT')

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
          <option value="Sumatera" {{ $distribution->region == 'Sumatera' ? 'selected' : '' }}>Sumatera
          </option>
          <option value="Lainnya" {{ $distribution->region == 'Lainnya' ? 'selected' : '' }}>Lainnya
          </option>
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

        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
        </div>
        </div>
      </div>
      </div>
    @endforeach
      </tbody>
      </table>
    </div>

    {{-- Tabel MBKM --}}
    <div class="col-md-6">
      <h5>MBKM (Merdeka Belajar Kampus Merdeka)</h5>
      <table class="table table-bordered">
      <thead>
        <tr>
        <th>No</th>
        <th>Wilayah</th>
        <th>Jumlah Mahasiswa</th>
        <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @php  $mbkmIndex = 1; @endphp
        @foreach ($mbkmDistributions as $distribution)
      <tr>
      <td>{{ $mbkmIndex++ }}</td>
      <td>{{ $distribution->region }}</td>
      <td>{{ $distribution->students }}</td>
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
      <div class="modal fade" id="editModal{{ $distribution->id }}" tabindex="-1" aria-labelledby="editModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Data Persebaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('distributionsedit', $distribution->id) }}" method="POST">
        @csrf
        @method('PUT')

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
          <option value="Sumatera" {{ $distribution->region == 'Sumatera' ? 'selected' : '' }}>Sumatera
          </option>
          <option value="Lainnya" {{ $distribution->region == 'Lainnya' ? 'selected' : '' }}>Lainnya
          </option>
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

        <button type="submit" class="btn btn-success">Simpan</button>
        </form>
        </div>
        </div>
      </div>
      </div>
    @endforeach
      </tbody>
      </table>
    </div>

@endif

    <hr>

    {{-- Form Tambah Data --}}
    <h3>Tambah Data Persebaran</h3>
    <form action="{{ route('distributionsadd') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="type" class="form-label">Jenis</label>
        <select name="type" id="type" class="form-select" required>
          <option value="">Pilih Jenis</option>
          <option value="KP">KP</option>
          <option value="MBKM">MBKM</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="region" class="form-label">Wilayah</label>
        <select name="region" id="region" class="form-select" required>
          <option value="">Pilih Wilayah</option>
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
  </div>

  <br>

</div>
@endsection