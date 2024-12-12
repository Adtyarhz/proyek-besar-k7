@extends('layouts.mahasiswa')

@section('title', 'Data Kelayakan MBKM - PRATIKMA')

@section('content')
<style>
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

  /* Responsive Table Styling */
  .table-responsive {
    margin-top: 20px;
  }
</style>

<!-- Display Success and Error Messages -->
@if(session('success'))
  <div class="alert alert-success text-center mt-3">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger text-center mt-3">
    {{ session('error') }}
  </div>
@endif

<!-- Data Kelayakan MBKM Section -->
<div class="container my-5">
  <h3 class="text-center mb-4">Data Kelayakan MBKM</h3>
  @forelse($dataKelayakan as $data)
    <div class="data-section">
    <div class="data-item">
      <label>Nilai IPK:</label>
      <p>{{ $data->nilai_ipk }}</p>
    </div>
    <div class="data-item">
      <label>Total SKS Semester 1-6:</label>
      <p>{{ $data->total_sks }}</p>
    </div>
    <div class="data-item">
      <label>SKS Semester 6:</label>
      <p>{{ $data->sks_semester6 }}</p>
    </div>
    <div class="data-item">
      <label>Mata Kuliah Tidak Lulus:</label>
      <p>{{ $data->mata_kuliah_tidak_lulus }}</p>
    </div>
    <div class="data-item">
      <label>Bukti SKS dan IPK:</label>
      @if($data->bukti_sks_ipk)
      <a href="{{ asset('storage/' . $data->bukti_sks_ipk) }}" target="_blank" class="btn btn-sm btn-primary">
      <i class="fas fa-file-alt"></i> Lihat Bukti
      </a>
    @else
      <span>Belum diunggah</span>
    @endif
    </div>
    <div class="data-item">
      <label>Status Kelayakan:</label>
      @if($data->status_kelayakan == 'Menunggu')
      <span class="badge badge-menunggu">Menunggu</span>
    @elseif($data->status_kelayakan == 'Disetujui')
      <span class="badge badge-disetujui">Disetujui</span>
    @elseif($data->status_kelayakan == 'Ditolak')
      <span class="badge badge-ditolak">Ditolak</span>
    @endif
    </div>

    <!-- Display Catatan from Dosen Wali, Kaprodi, Koordinator -->
    <hr class="my-4">
    <h5>Catatan dari Peran Terkait:</h5>
    <div class="data-item">
      <label>Catatan Dosen Wali:</label>
      <p>{{ $data->catatan_dosen_wali ?? 'Belum ada catatan dari Dosen Wali.' }}</p>
    </div>
    <div class="data-item">
      <label>Catatan Kaprodi:</label>
      <p>{{ $data->catatan_kaprodi ?? 'Belum ada catatan dari Kaprodi.' }}</p>
    </div>
    <div class="data-item">
      <label>Catatan Koordinator:</label>
      <p>{{ $data->catatan_koordinator ?? 'Belum ada catatan dari Koordinator.' }}</p>
    </div>
    </div>
  @empty
    <p class="text-center">Belum ada data Kelayakan MBKM yang diinput.</p>
  @endforelse
</div>
@endsection