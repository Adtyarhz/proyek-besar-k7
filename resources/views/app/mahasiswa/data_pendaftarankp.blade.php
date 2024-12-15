@extends('layouts.mahasiswa')

@section('title', 'Data Pendaftaran KP - PRATIKMA')

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
</style>

<!-- Display Success Message -->
@if(session('success'))
  <div class="alert alert-success text-center">
    {{ session('success') }}
  </div>
@endif

<!-- Data Pendaftaran KP Section -->
<div class="container my-5">
  <h3 class="text-center mb-4">Data Pendaftaran KP</h3>
  @forelse($dataPendaftaran as $data)
    <div class="data-section">
    <div class="data-item">
      <label>Nama:</label>
      <p>{{ $data->nama }}</p>
    </div>
    <div class="data-item">
      <label>NIM:</label>
      <p>{{ $data->nim }}</p>
    </div>
    <div class="data-item">
      <label>Email Mahasiswa:</label>
      <p>{{ $data->email }}</p>
    </div>
    <div class="data-item">
      <label>Nama Perusahaan:</label>
      <p>{{ $data->perusahaan }}</p>
    </div>
    <div class="data-item">
      <label>Email Perusahaan:</label>
      <p>{{ $data->email_perusahaan }}</p>
    </div>
    <div class="data-item">
      <label>Lokasi Perusahaan:</label>
      <p>{{ $data->lokasi }}</p>
    </div>
    <div class="data-item">
      <label>Role:</label>
      <p>{{ $data->role_kp }}</p>
    </div>
    <div class="data-item">
      <label>Rencana Pelaksanaan KP:</label>
      <p>{{ $data->tanggal_awal }} - {{ $data->tanggal_akhir }}</p>
    </div>
    <div class="data-item">
      <label>Surat Pengantar:</label>
      @if($data->surat_pengantar)
      <a href="{{ asset('storage/' . $data->surat_pengantar) }}" target="_blank" class="btn btn-sm btn-primary">
      <i class="fas fa-file-alt"></i> Lihat Bukti
      </a>
    @else
      <span>Belum diunggah</span>
    @endif
    </div>
    <div class="data-item">
      <label>Status Pendaftaran:</label>
      @if($data->status_pendaftaran == 'Menunggu' || $data->status_pendaftaran == null)
      <span class="badge badge-menunggu">Menunggu</span>
    @elseif($data->status_pendaftaran == 'Disetujui')
      <span class="badge badge-disetujui">Disetujui</span>
    @elseif($data->status_pendaftaran == 'Ditolak')
      <span class="badge badge-ditolak">Ditolak</span>
    @endif
    </div>

    <hr class="my-4">
    <h5>Catatan dari Peran Terkait (Eligible):</h5>
    <div class="data-item">
      <label>Catatan Dosen Wali:</label>
      <p>{{ $data->catatan_doswal_eligible ?? 'Belum ada catatan dari Dosen Wali.' }}</p>
    </div>
    <div class="data-item">
      <label>Catatan Kaprodi:</label>
      <p>{{ $data->catatan_kaprodi_eligible ?? 'Belum ada catatan dari Kaprodi.' }}</p>
    </div>
    <div class="data-item">
      <label>Catatan Koordinator:</label>
      <p>{{ $data->catatan_koordinator_eligible ?? 'Belum ada catatan dari Koordinator.' }}</p>
    </div>
    <div class="data-item">
      <label>SKS dari Koordinator:</label>
      <p>{{ $data->sks_koordinator !== null ? $data->sks_koordinator . ' SKS' : 'Belum ditentukan' }}</p>
    </div>
    </div>
  @empty
    <p class="text-center">Belum ada data Pendaftaran KP yang diinput.</p>
  @endforelse
</div>
@endsection