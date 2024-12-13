@extends('layouts.koordinator')

@section('title', 'Tabel KP - Kaprodi')

@section('content')

@if(session('success'))
  <div class="alert alert-success text-center mt-3">
    {{ session('success') }}
  </div>
@endif

<div class="container my-5">
  <h2 class="text-center">Daftar Peserta Kerja Praktik</h2>

  <table class="table table-bordered table-striped mt-4" id="dataTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Angkatan</th>
        <th>Tahun Mendaftar KP</th>
        <th>Jumlah SKS (Sem 1-5)</th>
        <th>Jumlah SKS (Sem 6)</th>
        <th>Eligible</th>
        <th>Bukti Lampiran</th>
        <th>Status</th>
        <th>Catatan Dosen Wali</th>
        <th>Catatan Kaprodi</th>
        <th>Catatan Koordinator</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kelayakanKPs as $index => $kp)
      <tr>
      <td>{{ $index + 1 }}</td>
      <td>{{ $kp->user->name }}</td>
      <td>{{ $kp->user->nim }}</td>
      <td>{{ $kp->user->angkatan }}</td>
      <td>{{ $kp->tahun_mendaftar }}</td>
      <td>{{ $kp->total_sks }}</td>
      <td>{{ $kp->sks_semester6 }}</td>
      <td>{{ $kp->mata_kuliah_tidak_lulus ? 'No' : 'Yes' }}</td>
      <td>
        @if($kp->bukti_sks_ipk)
      <a href="{{ asset('storage/' . $kp->bukti_sks_ipk) }}" target="_blank" class="btn btn-sm btn-primary">
      <i class="fas fa-file-alt"></i> Lihat Lampiran
      </a>
    @else
    <span>Belum diunggah</span>
  @endif
      </td>
      <td>
        @if($kp->status_kelayakan == 'Menunggu')
      <span class="badge bg-warning">Menunggu</span>
    @elseif($kp->status_kelayakan == 'Disetujui')
    <span class="badge bg-success">Disetujui</span>
  @elseif($kp->status_kelayakan == 'Ditolak')
  <span class="badge bg-danger">Ditolak</span>
@endif
      </td>
      <td>
        <!-- catatan_doswal view-only via modal -->
        @if($kp->catatan_doswal)
      <button class="btn btn-sm btn-info"
      onclick="showCatatan('{{ $kp->catatan_doswal }}', 'Catatan Dosen Wali')">View Catatan Dosen Wali</button>
    @else
    <span>-</span>
  @endif
      </td>
      <td>
        <!-- Kaprodi can add/edit catatan_kaprodi -->
        <a href="#" class="btn btn-sm btn-secondary" onclick="toggleCatatanForm({{ $kp->id }}, 'kaprodi')">
        @if($kp->catatan_kaprodi)
      Edit Catatan
    @else
    Add Catatan
  @endif
        </a>
        <div id="form-catatan-kaprodi-{{ $kp->id }}" class="mt-2" style="display: none;">
        <form action="{{ route('kaprodi.tabelinputkp.update_catatan', $kp->id) }}" method="POST">
          @csrf
          <textarea name="catatan" class="form-control" rows="3" required>{{ $kp->catatan_kaprodi }}</textarea>
          <button type="submit" class="btn btn-primary btn-sm mt-2">Save</button>
        </form>
        </div>
        @if($kp->catatan_kaprodi)
      <p>{{ $kp->catatan_kaprodi }}</p>
    @endif
      </td>
      <td>
        <!-- catatan_koordinator view-only via modal -->
        @if($kp->catatan_koordinator)
      <button class="btn btn-sm btn-info"
      onclick="showCatatan('{{ $kp->catatan_koordinator }}', 'Catatan Koordinator')">View Catatan
      Koordinator</button>
    @else
    <span>-</span>
  @endif
      </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>

<!-- Modal for viewing catatan -->
<div class="modal fade" id="catatanModal" tabindex="-1" aria-labelledby="catatanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="catatanModalLabel">Catatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="catatanTextarea" rows="5" readonly></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script>
  function toggleCatatanForm(id, role) {
    const form = document.getElementById(`form-catatan-${role}-${id}`);
    form.style.display = (form.style.display === "none") ? "block" : "none";
  }

  function showCatatan(catatan, title) {
    document.getElementById('catatanModalLabel').innerText = title;
    document.getElementById('catatanTextarea').value = catatan;
    var catatanModal = new bootstrap.Modal(document.getElementById('catatanModal'), {});
    catatanModal.show();
  }
</script>
@endsection