@extends('layouts.koordinator')

@section('title', 'Tabel Eligible MBKM - Koordinator')

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

<!-- Tabel Pendaftaran MBKM Section -->
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
          <th>Tanggal Pelaksanaan</th>
          <th>Lokasi MBKM</th>
          <th>Ekivalensi SKS</th>
          <th>Bukti Penerimaan</th>
          <th>Status</th>
          <th>Catatan Dosen Wali</th>
          <th>Catatan Kaprodi</th>
          <th>Catatan Koordinator</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pendaftaranMbkm as $index => $pendaftaran)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $pendaftaran->nama }}</td>
        <td>{{ $pendaftaran->nim }}</td>
        <td>{{ $pendaftaran->email }}</td>
        <td>{{ $pendaftaran->tanggal_awal_mbkm }} - {{ $pendaftaran->tanggal_akhir_mbkm }}</td>
        <td>{{ $pendaftaran->lokasi_mbkm }}</td>
        <td>{{ $pendaftaran->ekivalensi_sks ?? 'Belum ditentukan' }} SKS</td>
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
        <td>{{ $pendaftaran->catatan_dosen_wali ?? 'Belum ada catatan' }}</td>
        <td>{{ $pendaftaran->catatan_kaprodi ?? 'Belum ada catatan' }}</td>
        <td>
        @if($pendaftaran->catatan_koordinator)
      {{ $pendaftaran->catatan_koordinator }}
      <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal"
        data-bs-target="#editCommentModal{{ $pendaftaran->id }}">
        <i class="fas fa-edit"></i> Edit
      </button>
    @else
    <form action="{{ route('koordinator.tabel_mbkm.update_catatan', $pendaftaran->id) }}" method="POST">
      @csrf
      <div class="input-group">
      <input type="text" name="catatan_koordinator" class="form-control form-control-sm"
      placeholder="Tambah catatan" required>
      <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-save"></i></button>
      </div>
    </form>
  @endif
        </td>
        <td>
        @if($pendaftaran->sks_koordinator)
      {{ $pendaftaran->sks_koordinator }} SKS
    @else
    <form action="{{ route('koordinator.tabel_mbkm.update_sks', $pendaftaran->id) }}" method="POST"
      class="d-inline">
      @csrf
      <input type="number" name="sks" min="1" max="24" placeholder="SKS" required style="width: 60px;">
      <button type="submit" class="btn btn-sm btn-success" title="Simpan SKS"><i
      class="fas fa-save"></i></button>
    </form>
  @endif
        </td>
        <td>
        <!-- Status Update Form ----->
        <!-- Status Update Form -->

        <div class="btn-group" role="group" aria-label="Status Actions">
          @if($pendaftaran->status !== 'Disetujui')
        <form action="{{ route('koordinator.tabel_mbkm.update_status', $pendaftaran->id) }}" method="POST"
        class="d-inline">
        @csrf
        <input type="hidden" name="status" value="Disetujui">
        <button type="submit" class="btn btn-sm btn-success"
        onclick="return confirm('Apakah Anda yakin ingin menyetujui pendaftaran ini?')">
        <i class="fas fa-check"></i> Setujui
        </button>
        </form>
      @endif

          @if($pendaftaran->status !== 'Ditolak')
        <form action="{{ route('koordinator.tabel_mbkm.update_status', $pendaftaran->id) }}" method="POST"
        class="d-inline">
        @csrf
        <input type="hidden" name="status" value="Ditolak">
        <button type="submit" class="btn btn-sm btn-danger"
        onclick="return confirm('Apakah Anda yakin ingin menolak pendaftaran ini?')">
        <i class="fas fa-times"></i> Tolak
        </button>
        </form>
      @endif
        </div>
        </td>
      </tr>

      {{-- Modal for Editing Catatan Koordinator --}}
      @if($pendaftaran->catatan_koordinator)
      <div class="modal fade" id="editCommentModal{{ $pendaftaran->id }}" tabindex="-1"
      aria-labelledby="editCommentModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('koordinator.tabel_mbkm.update_catatan', $pendaftaran->id) }}" method="POST">
        @csrf
        <div class="modal-header">
        <h5 class="modal-title" id="editCommentModalLabel{{ $pendaftaran->id }}">Edit Catatan Koordinator</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
        <label for="catatan_koordinator{{ $pendaftaran->id }}" class="form-label">Catatan
          Koordinator</label>
        <input type="text" name="catatan_koordinator" class="form-control"
          id="catatan_koordinator{{ $pendaftaran->id }}"
          value="{{ old('catatan_koordinator', $pendaftaran->catatan_koordinator) }}" required>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
        </form>
      </div>
      </div>
      </div>
    @endif
    @empty
    <tr>
      <td colspan="13" class="text-center">Belum ada data Pendaftaran MBKM yang diinput.</td>
    </tr>
  @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection