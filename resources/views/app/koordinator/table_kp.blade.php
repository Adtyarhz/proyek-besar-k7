@extends('layouts.koordinator')

@section('title', 'Tabel Eligible KP - Koordinator')

@section('content')

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
        <th>SKS Koordinator</th>
        <th>Action Koordinator</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pendaftaranKPs as $index => $p)
        @php
        // If status_pendaftaran is null or empty, default to 'Menunggu'
        $currentStatus = $p->status_pendaftaran ?? 'Menunggu';
      @endphp
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
          @if($currentStatus == 'Menunggu')
        <span class="badge bg-warning">Menunggu</span>
      @elseif($currentStatus == 'Disetujui')
      <span class="badge bg-success">Disetujui</span>
    @elseif($currentStatus == 'Ditolak')
      <span class="badge bg-danger">Ditolak</span>
    @endif
        </td>
        <td>{{ $p->created_at->format('d M Y H:i') }}</td>
        <td>{{ $p->catatan_doswal_eligible ?? '-' }}</td>
        <td>{{ $p->catatan_kaprodi_eligible ?? '-' }}</td>
        <td>
          <a href="#" class="btn btn-sm btn-secondary" onclick="toggleCatatanForm({{ $p->id }}, 'koordinator')">
          @if($p->catatan_koordinator_eligible)
        Edit Catatan
      @else
      Add Catatan
    @endif
          </a>
          <div id="form-catatan-koordinator-{{ $p->id }}" class="mt-2" style="display: none;">
          <form action="{{ route('koordinator.tableeligiblekp.update_catatan', $p->id) }}" method="POST">
            @csrf
            <textarea name="catatan_koordinator_eligible" class="form-control" rows="3"
            required>{{ $p->catatan_koordinator_eligible }}</textarea>
            <button type="submit" class="btn btn-primary btn-sm mt-2">Save</button>
          </form>
          </div>
          @if($p->catatan_koordinator_eligible)
        <p>{{ $p->catatan_koordinator_eligible }}</p>
      @endif
        </td>
        <td>
          <a href="#" class="btn btn-sm btn-secondary" onclick="toggleSksForm({{ $p->id }})">
          @if($p->sks_koordinator !== null)
        Edit SKS
      @else
      Add SKS
    @endif
          </a>
          <div id="form-sks-koordinator-{{ $p->id }}" class="mt-2" style="display: none;">
          <form action="{{ route('koordinator.tableeligiblekp.update_sks', $p->id) }}" method="POST">
            @csrf
            <input type="number" name="sks_koordinator" class="form-control" value="{{ $p->sks_koordinator ?? 0 }}"
            required>
            <button type="submit" class="btn btn-primary btn-sm mt-2">Save</button>
          </form>
          </div>
          @if($p->sks_koordinator !== null)
        <p>{{ $p->sks_koordinator }} SKS</p>
      @endif
        </td>
        <td>
          @if($currentStatus == 'Menunggu')
        <form action="{{ route('koordinator.tableeligiblekp.update_status', $p->id) }}" method="POST"
        style="display:inline">
        @csrf
        <input type="hidden" name="status" value="Disetujui">
        <button class="btn btn-success btn-sm">Accept</button>
        </form>
        <form action="{{ route('koordinator.tableeligiblekp.update_status', $p->id) }}" method="POST"
        style="display:inline">
        @csrf
        <input type="hidden" name="status" value="Ditolak">
        <button class="btn btn-danger btn-sm">Reject</button>
        </form>
      @elseif($currentStatus == 'Disetujui')
      <form action="{{ route('koordinator.tableeligiblekp.update_status', $p->id) }}" method="POST">
      @csrf
      <input type="hidden" name="status" value="Ditolak">
      <button class="btn btn-warning btn-sm">Change to Reject</button>
      </form>
    @elseif($currentStatus == 'Ditolak')
      <form action="{{ route('koordinator.tableeligiblekp.update_status', $p->id) }}" method="POST">
      @csrf
      <input type="hidden" name="status" value="Disetujui">
      <button class="btn btn-success btn-sm">Change to Accept</button>
      </form>
    @endif
        </td>
        </tr>
    @endforeach
    </tbody>
  </table>
</div>

<script>
  function toggleCatatanForm(id, role) {
    const form = document.getElementById(`form-catatan-${role}-${id}`);
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
  }

  function toggleSksForm(id) {
    const form = document.getElementById(`form-sks-koordinator-${id}`);
    form.style.display = (form.style.display === "none" || form.style.display === "") ? "block" : "none";
  }
</script>
@endsection