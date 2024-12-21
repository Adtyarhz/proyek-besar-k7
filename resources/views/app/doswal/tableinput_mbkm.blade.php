@extends('layouts.doswal')

@section('title', 'Table Kelayakan MBKM - Dosen Wali')

@section('content')
<style>
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

  .catatan-textarea {
    width: 100%;
    resize: none;
  }

  @media (max-width: 768px) {
    table thead {
      display: none;
    }

    table,
    table tbody,
    table tr,
    table td {
      display: block;
      width: 100%;
    }

    table tr {
      margin-bottom: 15px;
    }

    table td {
      text-align: right;
      padding-left: 50%;
      position: relative;
    }

    table td::before {
      content: attr(data-label);
      position: absolute;
      left: 10px;
      width: 45%;
      padding-right: 10px;
      white-space: nowrap;
      text-align: left;
      font-weight: bold;
    }
  }

  tr.selected {
    background-color: #f1f1f1;
  }

  .save-button {
    display: none;
  }

  .navbar-nav .dropdown-menu {
    background-color: #003366;
  }

  .navbar-nav .dropdown-item {
    color: white;
  }

  .navbar-nav .dropdown-item:hover {
    background-color: #00508b;
  }

  html,
  body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
  }

  body {
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
  }

  .navbar-dark .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
  }

  thead th {
    text-align: center;
    vertical-align: middle;
  }
</style>

<!-- Alert Messages -->
<div class="container mt-4">
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
</div>

<!-- Tabel Section -->
<div class="container my-5">
  <h2 class="text-center mb-4">Daftar Peserta MBKM</h2>

  <table class="table table-bordered table-striped" id="dataTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Angkatan</th>
        <th>Nilai IPK</th>
        <th>Total SKS (Sem 1-5)</th>
        <th>SKS Semester 6</th>
        <th>Mata Kuliah Tidak Lulus</th>
        <th>Nilai Keasramaan</th>
        <th>Bukti Lampiran</th>
        <th>Status</th>
        <th>Catatan Dosen Wali</th>
        <th>Catatan Kaprodi</th>
        <th>Catatan Koordinator</th>
      </tr>
    </thead>

    <tbody>
      @foreach($kelayakanMBKMs as $index => $mbkm)
      <tr id="row-{{ $mbkm->id }}">
      <td data-label="No">{{ $index + 1 }}</td>
      <td data-label="Nama">{{ $mbkm->user->name }}</td>
      <td data-label="NIM">{{ $mbkm->user->nim }}</td>
      <td data-label="Angkatan">{{ $mbkm->user->angkatan }}</td>
      <td data-label="Nilai IPK">{{ $mbkm->nilai_ipk }}</td>
      <td data-label="Total SKS (Sem 1-6)">{{ $mbkm->total_sks }}</td>
      <td data-label="SKS Semester 6">{{ $mbkm->sks_semester6 }}</td>
      <td data-label="Mata Kuliah Tidak Lulus">{{ $mbkm->mata_kuliah_tidak_lulus }}</td>
      <td data-label="Nilai Keasramaan">{{ $mbkm->nilai_keasramaan }}</td>
      <td data-label="Bukti Lampiran">
        @if($mbkm->bukti_sks_ipk)
      <a href="{{ asset('storage/' . $mbkm->bukti_sks_ipk) }}" target="_blank" class="btn btn-sm btn-primary">
      <i class="fas fa-file-alt"></i> Lihat Lampiran
      </a>
    @else
    <span>Belum diunggah</span>
  @endif
      </td>

      <td data-label="Status">
        @if($mbkm->status_kelayakan == 'Menunggu')
      <span class="badge badge-menunggu">Menunggu</span>
    @elseif($mbkm->status_kelayakan == 'Disetujui')
    <span class="badge badge-disetujui">Disetujui</span>
  @elseif($mbkm->status_kelayakan == 'Ditolak')
  <span class="badge badge-ditolak">Ditolak</span>
@endif
      </td>

      <td data-label="Catatan Dosen Wali">
      <form action="{{ route('doswal.tabelinput_mbkm.update_catatan', $mbkm->id) }}" method="POST"
          class="d-inline-block">
          @csrf
          <textarea class="form-control catatan-textarea" name="catatan_dosen_wali"
          readonly>{{ $mbkm->catatan_dosen_wali }}</textarea>
          <button type="button" class="btn btn-sm btn-secondary mt-2 edit-comment"
          onclick="editComment({{ $mbkm->id }})">Edit</button>
          <button type="submit" class="btn btn-sm btn-success mt-2 save-comment save-button"
          style="display: none;">Save</button>
        </form>
      </td>

      <td data-label="Catatan Kaprodi">
        @if($mbkm->catatan_kaprodi)
      <button class="btn btn-sm btn-info"
      onclick="showCatatan('{{ addslashes($mbkm->catatan_kaprodi) }}', 'Catatan Kaprodi')">View</button>
    @else
    <span>-</span>
  @endif
      </td>

      <td data-label="Catatan Koordinator">
        @if($mbkm->catatan_koordinator)
      <button class="btn btn-sm btn-info"
      onclick="showCatatan('{{ addslashes($mbkm->catatan_koordinator) }}', 'Catatan Koordinator')">View</button>
    @else
    <span>-</span>
  @endif
      </td>
      </tr>
    @endforeach
    </tbody>
  </table>

  <!-- Modal untuk Menampilkan Komentar -->
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-V7oW2UsFq25e/4Irz0xHRv5kTyvT8r7ef6hl0N/IV6Gf0ZbAd1AJMcyPX6PJ3NRo" crossorigin="anonymous"></script>
<script>
  function showCatatan(catatan, title) {
    document.getElementById('catatanModalLabel').innerText = title;
    document.getElementById('catatanTextarea').value = catatan;
    var catatanModal = new bootstrap.Modal(document.getElementById('catatanModal'), {});
    catatanModal.show();
  }
  
  function editComment(id) {
    const textarea = document.querySelector(`#row-${id} .catatan-textarea`);
    const editButton = document.querySelector(`#row-${id} .edit-comment`);
    const saveButton = document.querySelector(`#row-${id} .save-comment`);

    if (textarea && editButton && saveButton) {
      textarea.readOnly = false;
      textarea.classList.add('bg-light'); // Indicate editable
      editButton.style.display = 'none';
      saveButton.style.display = 'inline-block';
    } else {
      console.error('Satu atau lebih elemen tidak ditemukan dalam baris.');
    }
  }

  function saveComment(id) {
    const textarea = document.querySelector(`#row-${id} .catatan-textarea`);
    const newComment = textarea.value.trim();

    if (newComment === '') {
      alert('Catatan tidak boleh kosong.');
      return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/doswal/tableinput_mbkm/${id}/update_catatan`;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = csrfToken;
    form.appendChild(tokenInput);

    const commentInput = document.createElement('input');
    commentInput.type = 'hidden';
    commentInput.name = 'catatan_dosen_wali';
    commentInput.value = newComment;
    form.appendChild(commentInput);

    document.body.appendChild(form);
    form.submit();
  }
</script>
@endsection