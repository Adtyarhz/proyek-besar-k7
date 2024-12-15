@extends('layouts.mahasiswa')

@section('title', 'Form Pendaftaran MBKM - PRATIKMA')

@section('content')
<!-- Alert Messages -->
<div class="container mt-4">
  @if(session('success'))
    <div class="alert alert-success text-center">
    {{ session('success') }}
    </div>
  @endif

  @if(session('info'))
    <div class="alert alert-info text-center">
    {{ session('info') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger text-center">
    {{ session('error') }}
    </div>
  @endif
</div>

<!-- Form Pendaftaran MBKM -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-4">
        <!-- Header -->
        <div class="card-header text-white text-center py-4 rounded-top" style="
                background: linear-gradient(90deg, #0073e6, #003366);
                font-size: 24px;
                font-weight: bold;
              ">
          <i class="fas fa-check-circle me-2"></i>
          Form Submit Dokumen Final MBKM
        </div>

        <!-- Body -->
        <div class="card-body p-5" style="
                background-image: url('https://www.transparenttextures.com/patterns/light-paper-fibers.png');
                background-color: #f9f9f9;
              ">
          <form action="{{ route('mbkm_pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama -->
            <div class="mb-3">
              <label for="nama" class="form-label fw-semibold">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->name }}" readonly>
            </div>

            <!-- NIM -->
            <div class="mb-3">
              <label for="nim" class="form-label fw-semibold">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim" value="{{ $user->nim }}" readonly>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
            </div>

            <!-- Rencana Pelaksanaan MBKM -->
            <div class="mb-3">
              <label for="pelaksanaan" class="form-label fw-semibold">Rencana Pelaksanaan MBKM</label>
              <div class="row">
                <div class="col-md-6">
                  <input type="date"
                    class="form-control rounded-3 shadow-sm @error('tanggal_awal_mbkm') is-invalid @enderror"
                    id="tanggal_awal_mbkm" name="tanggal_awal_mbkm" value="{{ old('tanggal_awal_mbkm') }}" required />
                  @error('tanggal_awal_mbkm')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
                  <small class="text-muted">Tanggal Awal</small>
                </div>
                <div class="col-md-6">
                  <input type="date"
                    class="form-control rounded-3 shadow-sm @error('tanggal_akhir_mbkm') is-invalid @enderror"
                    id="tanggal_akhir_mbkm" name="tanggal_akhir_mbkm" value="{{ old('tanggal_akhir_mbkm') }}" required />
                  @error('tanggal_akhir_mbkm')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
                  <small class="text-muted">Tanggal Akhir</small>
                </div>
              </div>
            </div>

            <!-- Lokasi MBKM -->
            <div class="mb-3">
              <label for="lokasi_mbkm" class="form-label fw-semibold">Lokasi MBKM</label>
              <input type="text" class="form-control" id="lokasi_mbkm" name="lokasi_mbkm"
                value="{{ old('lokasi_mbkm') }}" required>
              @error('lokasi_mbkm')
          <small class="text-danger">{{ $message }}</small>
        @enderror
            </div>

            <!-- Ekivalensi SKS -->
            <div class="mb-3">
              <label for="ekivalensi-sks" class="form-label fw-semibold">Ekivalensi Konversi SKS</label>
              <input type="text" class="form-control" id="ekivalensi_sks" name="ekivalensi_sks"
                placeholder="Berdasarkan yang sudah disetujui kordinator" value="{{ old('ekivalensi_sks') }}" required>
              @error('ekivalensi_sks')
          <small class="text-danger">{{ $message }}</small>
        @enderror
            </div>

            <!-- Bukti Penerimaan MBKM -->
            <div class="mb-4">
              <label for="bukti_penerimaan_mbkm" class="form-label fw-semibold">Bukti Penerimaan MBKM</label>
              <input type="file" class="form-control rounded-3 shadow-sm" id="bukti_penerimaan_mbkm"
                name="bukti_penerimaan_mbkm" accept=".pdf,.jpg,.jpeg,.png" />
              @error('bukti_penerimaan_mbkm')
          <small class="text-danger">{{ $message }}</small>
        @enderror
            </div>

            <!-- Divider -->
            <hr class="my-4" />

            <!-- Submit Button -->
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 shadow-lg">
                <i class="fas fa-paper-plane me-2"></i>Submit Form
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection