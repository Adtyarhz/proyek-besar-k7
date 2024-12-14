@extends('layouts.doswal')

@section('title', 'Tabel Eligible MBKM - Dosen Wali')

@section('content')

<style>
  /* Consistent CSS styles with Koordinator's view */
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  .navbar {
    background: linear-gradient(90deg, #0073e6, #003366);
  }

  .navbar-brand img {
    height: 50px;
  }

  .navbar-nav .nav-link {
    color: white !important;
    margin-right: 20px;
  }

  .navbar-nav .nav-link:hover {
    color: #cccccc !important;
  }

  .navbar .fa-bell {
    color: white;
    font-size: 24px;
    margin-right: 15px;
  }

  .navbar .fa-user-circle {
    color: white;
    font-size: 24px;
  }

  .navbar .notification-bell {
    position: relative;
  }

  .navbar .notification-badge {
    position: absolute;
    top: -10px;
    right: -5px;
    background-color: red;
    color: white;
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 50%;
  }

  .navbar-toggler-icon {
    background-color: white;
  }

  /* Dropdown Styling */
  .navbar-nav .dropdown-menu {
    background-color: #003366;
  }

  .navbar-nav .dropdown-item {
    color: white;
  }

  .navbar-nav .dropdown-item:hover {
    background-color: #00508b;
  }

  .footer {
    background-color: #003366;
    padding: 20px 0;
    margin-top: auto;
  }

  .footer h5 {
    font-weight: bold;
    font-size: 18px;
  }

  .footer p {
    font-size: 14px;
    margin: 0;
    color: #cccccc;
  }

  .footer a {
    text-decoration: none;
    color: white;
    transition: color 0.3s ease;
  }

  .footer .fab,
  .footer .fas {
    margin-right: 10px;
    transition: transform 0.3s ease;
  }

  .footer .fab:hover,
  .footer .fas:hover {
    transform: scale(1.2);
  }

  .footer small {
    color: #aaaaaa;
    font-size: 12px;
  }

  .badge-menunggu {
    background-color: #ffc107;
    color: #000;
  }

  .badge-disetujui {
    background-color: #28a745;
    color: #fff;
  }

  .badge-ditolak {
    background-color: #dc3545;
    color: #fff;
  }

  /* Responsive table */
  @media (max-width: 768px) {
    .table-responsive {
      overflow-x: auto;
    }
  }

  /* Button spacing */
  .btn-group {
    display: flex;
    gap: 5px;
  }
</style>

<!-- Tabel MBKM Section -->
<div class="container my-5">
  <h2 class="text-center">Daftar Pendaftaran MBKM</h2>

  @if(session('success'))
    <div class="alert alert-success text-center">
    {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger text-center">
    {{ session('error') }}
    </div>
  @endif

  <div class="table-responsive">
    <table class="table table-bordered table-striped mt-4" id="pendaftaranTable">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>NIM</th>
          <th>Email</th>
          <th>Rencana Pelaksanaan MBKM</th>
          <th>Lokasi MBKM</th>
          <th>Bukti Penerimaan</th>
          <th>Status</th>
          <th>Catatan Dosen Wali</th>
          <th>Catatan Kaprodi</th>
          <th>Catatan Koordinator</th>
          <!-- Removed Jumlah SKS and Aksi columns -->
        </tr>
      </thead>
      <tbody>
        @forelse($pendaftaranMbkm as $index => $pendaftaran)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $pendaftaran->nama }}</td>
        <td>{{ $pendaftaran->nim }}</td>
        <td>{{ $pendaftaran->email }}</td>
        <td>{{ Str::limit($pendaftaran->rencana_pelaksanaan_mbkm, 50, '...') }}</td>
        <td>{{ $pendaftaran->lokasi_mbkm }}</td>
        <td>
        @if($pendaftaran->bukti_penerimaan_mbkm)
      <a href="{{ asset('storage/' . $pendaftaran->bukti_penerimaan_mbkm) }}" target="_blank"
        class="btn btn-sm btn-primary">
        <i class="fas fa-file-alt"></i> Lihat Bukti
      </a>
    @else
    <span>Belum diunggah</span>
  @endif
        </td>
        <td>
        @if($pendaftaran->status == 'Menunggu' || $pendaftaran->status == null)
      <span class="badge badge-menunggu">Menunggu</span>
    @elseif($pendaftaran->status == 'Disetujui')
    <span class="badge badge-disetujui">Disetujui</span>
  @elseif($pendaftaran->status == 'Ditolak')
  <span class="badge badge-ditolak">Ditolak</span>
@endif
        </td>
        <td>
        {{ $pendaftaran->catatan_dosen_wali ?? 'Belum ada catatan' }}
        <br>
        <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal"
          data-bs-target="#catatanDoswalModal{{ $pendaftaran->id }}">
          @if($pendaftaran->catatan_dosen_wali)
        <i class="fas fa-edit"></i> Edit
      @else
      <i class="fas fa-plus"></i> Tambah
    @endif
        </button>
        </td>
        <td>
        {{ $pendaftaran->catatan_kaprodi ?? 'Belum ada catatan' }}
        <br>
        <!-- Kaprodi comments are view-only for Doswal -->
        @if($pendaftaran->catatan_kaprodi)
      <i class="fas fa-eye"></i> Lihat
    @else
    <span>Belum ada catatan</span>
  @endif
        </td>
        <td>
        {{ $pendaftaran->catatan_koordinator ?? 'Belum ada catatan' }}
        <br>
        <!-- Koordinator comments are view-only for Doswal -->
        @if($pendaftaran->catatan_koordinator)
      <i class="fas fa-eye"></i> Lihat
    @else
    <span>Belum ada catatan</span>
  @endif
        </td>
      </tr>

      {{-- Modal for Adding/Editing Catatan Dosen Wali --}}
      <div class="modal fade" id="catatanDoswalModal{{ $pendaftaran->id }}" tabindex="-1"
        aria-labelledby="catatanDoswalModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('doswal.tabel_mbkm.update_catatan', $pendaftaran->id) }}" method="POST">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="catatanDoswalModalLabel{{ $pendaftaran->id }}">
            @if($pendaftaran->catatan_dosen_wali)
        Edit Catatan Dosen Wali
      @else
    Tambah Catatan Dosen Wali
  @endif
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
            <label for="catatan_dosen_wali{{ $pendaftaran->id }}" class="form-label">Catatan Dosen Wali</label>
            <textarea name="catatan_dosen_wali" class="form-control"
              id="catatan_dosen_wali{{ $pendaftaran->id }}" rows="3"
              required>{{ old('catatan_dosen_wali', $pendaftaran->catatan_dosen_wali) }}</textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">
            @if($pendaftaran->catatan_dosen_wali)
        Simpan Perubahan
      @else
    Simpan
  @endif
            </button>
          </div>
          </form>
        </div>
        </div>
      </div>
    @empty
    <tr>
      <td colspan="11" class="text-center">Belum ada data Pendaftaran MBKM yang diinput.</td>
    </tr>
  @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection