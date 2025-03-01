@extends('layouts.mahasiswa')

@section('title', 'Form Kelayakan KP - PRATIKMA')

@section('content')
<style>
  /* Form Styling */
  .card-header {
    background: linear-gradient(90deg, #0073e6, #003366);
    font-size: 24px;
    font-weight: bold;
  }

  .card-body {
    background-color: #f9f9f9;
    background-image: url('https://www.transparenttextures.com/patterns/light-paper-fibers.png');
  }
</style>

<!-- Display Validation Errors -->
@if ($errors->any())
  <div class="container-flex my-4">
    <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
  </div>
@endif

<!-- Display Success Message -->
@if(session('success'))
  <div class="container-flex my-4">
    <div class="alert alert-success text-center">
    {{ session('success') }}
    </div>
  </div>
@endif

<!-- Form Section -->
<div class="container-flex my-5">
  <!-- Form Input Data -->
  <form id="formKelayakanKP" action="{{ route('kp.formkelayakan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
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
            Form Kelayakan KP
          </div>

          <!-- Body -->
          <div class="card-body p-5">
            <!-- Nilai IPK -->
            <div class="mb-4">
              <label for="nilai_ipk" class="form-label fw-semibold">
                Nilai IPK
              </label>
              <input type="number" step="0.01" class="form-control rounded-3 shadow-sm" id="nilai_ipk" name="nilai_ipk"
                placeholder="Masukkan nilai IPK" value="{{ old('nilai_ipk') }}" required />
            </div>

            <!-- Divider -->
            <hr class="my-4" />

            <!-- Total SKS Semester 1-5 -->
            <div class="mb-4">
              <label for="total_sks" class="form-label fw-semibold">
                Total SKS Semester 1-5
              </label>
              <input type="number" class="form-control rounded-3 shadow-sm" id="total_sks" name="total_sks"
                placeholder="Masukkan total SKS" value="{{ old('total_sks') }}" required />
            </div>

            <!-- Divider -->
            <hr class="my-4" />

            <!-- SKS Semester 6 -->
            <div class="mb-4">
              <label for="sks_semester6" class="form-label fw-semibold">
                SKS Semester 6
              </label>
              <input type="number" class="form-control rounded-3 shadow-sm" id="sks_semester6" name="sks_semester6"
                placeholder="Masukkan SKS Semester 6" value="{{ old('sks_semester6') }}" required />
            </div>

            <!-- Divider -->
            <hr class="my-4" />

            <!-- Mata Kuliah Tidak Lulus -->
            <div class="mb-4">
              <label for="mata_kuliah_tidak_lulus" class="form-label fw-semibold">
                Mata Kuliah Tidak Lulus (Sem 1-6)
              </label>
              <input type="text" class="form-control rounded-3 shadow-sm" id="mata_kuliah_tidak_lulus"
                name="mata_kuliah_tidak_lulus" placeholder="Masukkan mata kuliah tidak lulus"
                value="{{ old('mata_kuliah_tidak_lulus') }}" required />
            </div>

            <!-- Divider -->
            <hr class="my-4" />

            <!-- Bukti SKS dan IPK -->
            <div class="mb-4">
              <label for="bukti_sks_ipk" class="form-label fw-semibold">
                Bukti SKS dan IPK
              </label>
              <input type="file" class="form-control rounded-3 shadow-sm" id="bukti_sks_ipk" name="bukti_sks_ipk"
                accept=".pdf,.jpg,.jpeg,.png" required />
              <small class="form-text text-muted">
                Format yang diterima: PDF, JPG, JPEG, PNG. Maksimal ukuran 2MB.
              </small>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
              <button type="submit" class="btn btn-primary rounded-3 px-5 py-2 shadow-lg">
                <i class="fas fa-paper-plane me-2"></i>Submit Form
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection