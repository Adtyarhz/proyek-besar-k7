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
              <label for="rencana_pelaksanaan_mbkm" class="form-label fw-semibold">Rencana Pelaksanaan MBKM</label>
              <textarea class="form-control" id="rencana_pelaksanaan_mbkm" name="rencana_pelaksanaan_mbkm" rows="4"
                required>{{ old('rencana_pelaksanaan_mbkm') }}</textarea>
              @error('rencana_pelaksanaan_mbkm')
          <small class="text-danger">{{ $message }}</small>
        @enderror
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