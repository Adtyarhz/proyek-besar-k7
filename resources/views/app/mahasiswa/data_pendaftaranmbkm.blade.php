@extends('layouts.mahasiswa')

@section('title', 'Data Pendaftaran MBKM - PRATIKMA')

@section('content')
<style>
  /* CSS yang konsisten dan responsif */
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
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

  .data-section {
    background: #ffffff;
    padding: 30px 20px;
    margin-bottom: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .data-item {
    margin-bottom: 15px;
  }

  .data-item label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
  }

  .badge-menunggu {
    background-color: #ffc107;
    color: #000;
  }

  .badge-disetujui {
    background-color: #28a745;
  }

  .badge-ditolak {
    background-color: #dc3545;
  }
</style>

<!-- Display Success Message -->
@if(session('success'))
  <div class="alert alert-success text-center">
    {{ session('success') }}
  </div>
@endif

<!-- Display Error Message -->
@if(session('error'))
  <div class="alert alert-danger text-center">
    {{ session('error') }}
  </div>
@endif

<!-- Display Success Message -->
@if(session('success'))
  <div class="alert alert-success text-center">
    {{ session('success') }}
  </div>
@endif

<!-- Display Error Message -->
@if(session('error'))
  <div class="alert alert-danger text-center">
    {{ session('error') }}
  </div>
@endif

<!-- Data Pendaftaran MBKM Section -->
<div class="container my-5">
  <h3 class="text-center mb-4">Data Pendaftaran MBKM</h3>

  @if($pendaftaranMbkm)
    <div class="data-section">
    <div class="data-item">
      <label>Nama:</label>
      <p>{{ $pendaftaranMbkm->nama }}</p>
    </div>
    <div class="data-item">
      <label>NIM:</label>
      <p>{{ $pendaftaranMbkm->nim }}</p>
    </div>
    <div class="data-item">
      <label>Email:</label>
      <p>{{ $pendaftaranMbkm->email }}</p>
    </div>
    <div class="data-item">
      <label>Rencana Pelaksanaan MBKM:</label>
      <p>{{ $pendaftaranMbkm->tanggal_awal_mbkm }} - {{ $pendaftaranMbkm->tanggal_akhir_mbkm }}</p>
    </div>
    <div class="data-item">
      <label>Lokasi MBKM:</label>
      <p>{{ $pendaftaranMbkm->lokasi_mbkm }}</p>
    </div>
    <div class="data-item">
      <label>Bukti Penerimaan MBKM:</label>
      @if($pendaftaranMbkm->bukti_penerimaan_mbkm)
      <a href="{{ asset('storage/' . $pendaftaranMbkm->bukti_penerimaan_mbkm) }}" target="_blank"
      class="btn btn-sm btn-primary">
      <i class="fas fa-file-alt"></i> Lihat Bukti
      </a>
    @else
      <span>Belum diunggah</span>
    @endif
    </div>
    <div class="data-item">
      <label>Status Pendaftaran:</label>
      @if($pendaftaranMbkm->status == 'Menunggu' || $pendaftaranMbkm->status == null)
      <span class="badge badge-menunggu">Menunggu</span>
    @elseif($pendaftaranMbkm->status == 'Disetujui')
      <span class="badge badge-disetujui">Disetujui</span>
    @elseif($pendaftaranMbkm->status == 'Ditolak')
      <span class="badge badge-ditolak">Ditolak</span>
    @endif
    </div>

    <!-- Ekivalensi SKS -->
    <div class="data-item">
      <label>Ekivalensi Konversi SKS:</label>
      @if($pendaftaranMbkm->ekivalensi_sks)
      <p>{{ $pendaftaranMbkm->ekivalensi_sks }} SKS</p>
    @else
      <span>Belum ditentukan.</span>
    @endif
    </div>

    <hr class="my-4">
    <h5>Catatan:</h5>
    <div class="data-item">
      <label>Catatan Dosen Wali:</label>
      <p>{{ $pendaftaranMbkm->catatan_dosen_wali ?? 'Belum ada catatan dari Dosen Wali.' }}</p>
    </div>
    <div class="data-item">
      <label>Catatan Kaprodi:</label>
      <p>{{ $pendaftaranMbkm->catatan_kaprodi ?? 'Belum ada catatan dari Kaprodi.' }}</p>
    </div>
    <div class="data-item">
      <label>Catatan Koordinator:</label>
      <p>{{ $pendaftaranMbkm->catatan_koordinator ?? 'Belum ada catatan dari Koordinator.' }}</p>
    </div>
    </div>
  @else
    <p class="text-center">Belum ada data pendaftaran MBKM.</p>
  @endif
</div>
@endsection