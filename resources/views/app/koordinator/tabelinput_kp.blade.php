@extends('layouts.koordinator')

@section('title', 'Tabel KP - Koordinator')

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
        <th>IPK</th>
        <th>Jumlah SKS (Sem 1-5)</th>
        <th>Jumlah SKS (Sem 6)</th>
        <th>Mata Kuliah Tidak Lulus</th>
        <th>Bukti Lampiran</th>
        <th>Eligible</th>
        <th>Status</th>
        <th>Catatan Dosen Wali</th>
        <th>Catatan Kaprodi</th>
        <th>Catatan Koordinator</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kelayakanKPs as $index => $kp)
        <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $kp->user->name }}</td>
        <td>{{ $kp->user->nim }}</td>
        <td>{{ $kp->user->angkatan }}</td>
        <td>{{ $kp->nilai_ipk }}</td>
        <td>{{ $kp->total_sks }}</td>
        <td>{{ $kp->sks_semester6 }}</td>
        <td>{{ $kp->mata_kuliah_tidak_lulus }}</td>
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
          @if(
        $kp->total_sks >= 81 &&
        $kp->sks_semester6 >= 16 &&
        $kp->nilai_ipk >= 3.00 &&
        (empty($kp->mata_kuliah_tidak_lulus) || $kp->mata_kuliah_tidak_lulus === '-' || strlen($kp->mata_kuliah_tidak_lulus) === 1)
        )
          <span class="badge bg-success">Ya</span>
      @else
      <span class="badge bg-danger">Tidak</span>
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
          @if($kp->catatan_doswal)
        <button class="btn btn-sm btn-info"
        onclick="showCatatan('{{ $kp->catatan_doswal }}', 'Catatan Dosen Wali')">View Catatan Dosen Wali</button>
      @else
      <span>-</span>
    @endif
        </td>
        <td>
          @if($kp->catatan_kaprodi)
        <button class="btn btn-sm btn-info"
        onclick="showCatatan('{{ $kp->catatan_kaprodi }}', 'Catatan Kaprodi')">View Catatan Kaprodi</button>
      @else
      <span>-</span>
    @endif
        </td>
        <td>
          <a href="#" class="btn btn-sm btn-secondary" onclick="toggleCatatanForm({{ $kp->id }}, 'koordinator')">
          @if($kp->catatan_koordinator)
        Edit Catatan
      @else
      Add Catatan
    @endif
          </a>
          <div id="form-catatan-koordinator-{{ $kp->id }}" class="mt-2" style="display: none;">
          <form action="{{ route('koordinator.tabelinputkp.update_catatan', $kp->id) }}" method="POST">
            @csrf
            <textarea name="catatan" class="form-control" rows="3" required>{{ $kp->catatan_koordinator }}</textarea>
            <button type="submit" class="btn btn-primary btn-sm mt-2">Save</button>
          </form>
          </div>
          @if($kp->catatan_koordinator)
        <p>{{ $kp->catatan_koordinator }}</p>
      @endif
        </td>
        <td>
          @if($kp->status_kelayakan == 'Menunggu')
        <button class="btn btn-success btn-sm me-2"
        onclick="confirmStatusChange({{ $kp->id }}, 'Disetujui')">Accept</button>
        <button class="btn btn-danger btn-sm" onclick="confirmStatusChange({{ $kp->id }}, 'Ditolak')">Reject</button>
      @elseif($kp->status_kelayakan == 'Disetujui')
      <button class="btn btn-success btn-sm" onclick="confirmStatusChange({{ $kp->id }}, 'Ditolak')">Change to
      Reject</button>
    @elseif($kp->status_kelayakan == 'Ditolak')
      <button class="btn btn-danger btn-sm" onclick="confirmStatusChange({{ $kp->id }}, 'Disetujui')">Change to
      Accept</button>
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

  function confirmStatusChange(id, newStatus) {
    let confirmation = '';
    if (newStatus === 'Disetujui') {
      confirmation = 'Apakah Anda yakin ingin menyetujui aplikasi ini?';
    } else if (newStatus === 'Ditolak') {
      confirmation = 'Apakah Anda yakin ingin menolak aplikasi ini?';
    }

    if (confirm(confirmation)) {
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = `/tabelinput_kp_koordinator/${id}/status`;

      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const tokenInput = document.createElement('input');
      tokenInput.type = 'hidden';
      tokenInput.name = '_token';
      tokenInput.value = csrfToken;
      form.appendChild(tokenInput);

      const statusInput = document.createElement('input');
      statusInput.type = 'hidden';
      statusInput.name = 'status';
      statusInput.value = newStatus;
      form.appendChild(statusInput);

      document.body.appendChild(form);
      form.submit();
    }
  }
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection