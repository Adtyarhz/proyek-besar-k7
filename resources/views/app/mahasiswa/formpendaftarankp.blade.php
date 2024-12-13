@extends('layouts.mahasiswa')

@section('title', 'Form Pendaftaran Kerja Praktik')

@section('content')
<!-- Form Section -->
<div class="container my-5">
  <!-- Display errors -->
  @if ($errors->any())
    <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
  @endif

  <!-- Display success or error message -->
  @if(session('error'))
    <div class="alert alert-danger text-center">
    {{ session('error') }}
    </div>
  @endif

  @if(session('success'))
    <div class="alert alert-success text-center">
    {{ session('success') }}
    </div>
  @endif

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
          Form Pendaftaran KP
        </div>

        <!-- Body -->
        <div class="card-body p-5" style="
            background-image: url('https://www.transparenttextures.com/patterns/light-paper-fibers.png');
            background-color: #f9f9f9;
          ">
          <form action="{{ route('kp.formpendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama -->
            <div class="mb-4">
              <label for="nama" class="form-label fw-semibold">Nama</label>
              <input type="text" class="form-control rounded-3 shadow-sm @error('nama') is-invalid @enderror" id="nama"
                name="nama" placeholder="Masukkan nama" value="{{ old('nama', Auth::user()->name) }}" required />
              @error('nama')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            </div>

            <hr class="my-4" />

            <!-- NIM -->
            <div class="mb-4">
              <label for="nim" class="form-label fw-semibold">NIM</label>
              <input type="text" class="form-control rounded-3 shadow-sm @error('nim') is-invalid @enderror" id="nim"
                name="nim" placeholder="Masukkan NIM" value="{{ old('nim', Auth::user()->nim) }}" required />
              @error('nim')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            </div>

            <hr class="my-4" />

            <!-- Email -->
            <div class="mb-4">
              <label for="email" class="form-label fw-semibold">Email</label>
              <input type="email" class="form-control rounded-3 shadow-sm @error('email') is-invalid @enderror"
                id="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email', Auth::user()->email) }}"
                required />
              @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            </div>

            <hr class="my-4" />

            <!-- Nama Perusahaan -->
            <div class="mb-4">
              <label for="perusahaan" class="form-label fw-semibold">Nama Perusahaan</label>
              <input type="text" class="form-control rounded-3 shadow-sm @error('perusahaan') is-invalid @enderror"
                id="perusahaan" name="perusahaan" placeholder="Masukkan nama perusahaan" value="{{ old('perusahaan') }}"
                required />
              @error('perusahaan')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            </div>

            <hr class="my-4" />

            <!-- Rencana Pelaksanaan KP -->
            <div class="mb-4">
              <label for="pelaksanaan" class="form-label fw-semibold">Rencana Pelaksanaan KP</label>
              <textarea class="form-control rounded-3 shadow-sm @error('pelaksanaan') is-invalid @enderror"
                id="pelaksanaan" name="pelaksanaan" rows="4" placeholder="Masukkan rencana pelaksanaan KP"
                required>{{ old('pelaksanaan') }}</textarea>
              @error('pelaksanaan')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            </div>

            <hr class="my-4" />

            <!-- Lokasi KP -->
            <div class="mb-4">
              <label for="lokasi" class="form-label fw-semibold">Lokasi KP</label>
              <textarea class="form-control rounded-3 shadow-sm @error('lokasi') is-invalid @enderror" id="lokasi"
                name="lokasi" rows="4" placeholder="Masukkan lokasi perusahaan" required>{{ old('lokasi') }}</textarea>
              @error('lokasi')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            </div>

            <hr class="my-4" />

            <!-- Bukti Penerimaan -->
            <div class="mb-4">
              <label for="bukti-penerimaan" class="form-label fw-semibold">Bukti Penerimaan</label>
              <input type="file"
                class="form-control rounded-3 shadow-sm @error('bukti-penerimaan') is-invalid @enderror"
                id="bukti-penerimaan" name="bukti-penerimaan" accept=".pdf,.jpg,.jpeg,.png" />
              @error('bukti-penerimaan')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
              <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Max 2MB.</small>
            </div>

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