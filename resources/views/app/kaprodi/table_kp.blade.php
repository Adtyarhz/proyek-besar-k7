@extends('layouts.kaprodi')

@section('title', 'Tabel Eligible KP - Kaprodi')

@section('content')
<style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
      }
      body {
        font-family: Arial, sans-serif;
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
    </style>

@if(session('success'))
  <div class="alert alert-success text-center mt-3">
    {{ session('success') }}
  </div>
@endif

<div class="container my-5">
  <h2 class="text-center">Daftar Peserta Kerja Praktik (Eligible KP - Newest Data)</h2>
  <table class="table table-bordered table-striped mt-4" id="dataTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Angkatan</th>
        <th>Perusahaan</th>
        <th>Rencana Pelaksanaan</th>
        <th>Lokasi</th>
        <th>Bukti Penerimaan</th>
        <th>Status</th>
        <th>Tanggal Daftar</th>
        <th>Catatan Dosen Wali (Eligible)</th>
        <th>Catatan Kaprodi (Eligible)</th>
        <th>Catatan Koordinator (Eligible)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pendaftaranKPs as $index => $p)
      <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $p->nama }}</td>
      <td>{{ $p->nim }}</td>
      <td>{{ $p->user->angkatan }}</td>
      <td>{{ $p->perusahaan }}</td>
      <td>{{ $p->pelaksanaan }}</td>
      <td>{{ $p->lokasi }}</td>
      <td>
        @if($p->bukti_penerimaan)
      <a href="{{ asset('storage/' . $p->bukti_penerimaan) }}" target="_blank" class="btn btn-sm btn-primary">
      <i class="fas fa-file-alt"></i> Lihat Bukti
      </a>
    @else
    <span>Belum diunggah</span>
  @endif
      </td>
      <td>
        @if($p->status_pendaftaran == 'Menunggu')
      <span class="badge bg-warning">Menunggu</span>
    @elseif($p->status_pendaftaran == 'Disetujui')
    <span class="badge bg-success">Disetujui</span>
  @elseif($p->status_pendaftaran == 'Ditolak')
  <span class="badge bg-danger">Ditolak</span>
@endif
      </td>
      <td>{{ $p->created_at->format('d M Y H:i') }}</td>
      <td>{{ $p->catatan_doswal_eligible ?? '-' }}</td>
      <td>
        <!-- Kaprodi can edit/add catatan_kaprodi_eligible -->
        <a href="#" class="btn btn-sm btn-secondary" onclick="toggleCatatanForm({{ $p->id }}, 'kaprodi')">
        @if($p->catatan_kaprodi_eligible)
      Edit Catatan
    @else
    Add Catatan
  @endif
        </a>
        <div id="form-catatan-kaprodi-{{ $p->id }}" class="mt-2" style="display: none;">
        <form action="{{ route('kaprodi.tableeligiblekp.update_catatan', $p->id) }}" method="POST">
          @csrf
          <textarea name="catatan_kaprodi_eligible" class="form-control" rows="3"
          required>{{ $p->catatan_kaprodi_eligible }}</textarea>
          <button type="submit" class="btn btn-primary btn-sm mt-2">Save</button>
        </form>
        </div>
        @if($p->catatan_kaprodi_eligible)
      <p>{{ $p->catatan_kaprodi_eligible }}</p>
    @endif
      </td>
      <td>{{ $p->catatan_koordinator_eligible ?? '-' }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

<script>
  function toggleCatatanForm(id, role) {
    const form = document.getElementById(`form-catatan-${role}-${id}`);
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  }
</script>
@endsection