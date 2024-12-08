<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Form Pendaftaran Kerja Praktik</title>
    <link
      rel="icon"
      href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
</head>
<body>
@php
  $user = Auth::user();
  $userRole = $user ? $user->role : null;
@endphp

<nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #0073e6, #003366);">
  <div class="container">
    <a class="navbar-brand"
       href="
         @if($userRole === 'Doswal') 
           {{ route('home.doswal') }}
         @elseif($userRole === 'Kaprodi') 
           {{ route('home.kaprodi') }}
         @elseif($userRole === 'Koordinator') 
           {{ route('home.koordinator') }}
         @elseif($userRole === 'Mahasiswa') 
           {{ route('home.mahasiswa') }}
         @else 
           {{ route('home') }}
         @endif
       ">
      <img
        alt="Logo"
        src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png"
        style="height: 50px; margin-right: 10px"
      />
      <span style="font-size: 24px; color: white; font-weight: bold">PRATIKMA</span>
    </a>

    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarContent"
      aria-controls="navbarContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon" style="background-color: white;"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link
            @if(in_array(Route::currentRouteName(), ['home', 'home.doswal', 'home.kaprodi', 'home.koordinator', 'home.mahasiswa']))
              active
            @endif
          "
          href="
            @if($userRole === 'Doswal') 
              {{ route('home.doswal') }}
            @elseif($userRole === 'Kaprodi') 
              {{ route('home.kaprodi') }}
            @elseif($userRole === 'Koordinator') 
              {{ route('home.koordinator') }}
            @elseif($userRole === 'Mahasiswa') 
              {{ route('home.mahasiswa') }}
            @else 
              {{ route('home') }}
            @endif
          ">
            Beranda
          </a>
        </li>

        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdownMBKM"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            MBKM
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMBKM">
            <li><a class="dropdown-item" href="{{ route('mbkm.informasi') }}">Informasi</a></li>
            <li><a class="dropdown-item" href="{{ route('mbkm.formkelayakan') }}">Form Kelayakan MBKM</a></li>
            <li><a class="dropdown-item" href="{{ route('mbkm_pendaftaran.create') }}">Form Final MBKM</a></li>
            <li><a class="dropdown-item" href="{{ route('mbkm.data_kelayakan') }}">Data Kelayakan MBKM</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown2"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Kerja Praktik
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <li><a class="dropdown-item" href="{{ route('kp.informasi') }}">Informasi</a></li>
            <li><a class="dropdown-item" href="{{ route('kp.formkelayakan') }}">Form Kelayakan KP</a></li>
            <li><a class="dropdown-item" href="{{ route('kp.formpendaftaran') }}">Form Pendaftaran KP</a></li>
            <li><a class="dropdown-item" href="{{ route('kp.data_kelayakan') }}">Data Kelayakan KP</a></li>
            <li><a class="dropdown-item" href="{{ route('kp.data_pendaftaran') }}">Data Pendaftaran KP</a></li>
            <li><a class="dropdown-item" href="{{ route('mbkm_pendaftaran.data') }}">Data Pendaftaran MBKM</a></li>
          </ul>
        </li>
      </ul>

      <div class="d-flex align-items-center ms-3">
        <div class="notification-bell me-3">
          <a href="#" onclick="showNotifications(event)" style="text-decoration: none">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
          </a>
        </div>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
             id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            @if(Auth::user()->profile_photo)
              <img src="{{ asset('storage/profile_photos/' . Auth::user()->profile_photo) }}" alt="Profile Photo"
                   width="32" height="32" class="rounded-circle me-2">
            @else
              <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile Photo"
                   width="32" height="32" class="rounded-circle me-2">
            @endif
            <strong>{{ Auth::user()->name }}</strong>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
            <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <a class="dropdown-item" href="#"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                 Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>

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
        <div
          class="card-header text-white text-center py-4 rounded-top"
          style="
            background: linear-gradient(90deg, #0073e6, #003366);
            font-size: 24px;
            font-weight: bold;
          "
        >
          <i class="fas fa-check-circle me-2"></i>
          Form Pendaftaran KP
        </div>

        <!-- Body -->
        <div
          class="card-body p-5"
          style="
            background-image: url('https://www.transparenttextures.com/patterns/light-paper-fibers.png');
            background-color: #f9f9f9;
          "
        >
          <form action="{{ route('kp.formpendaftaran.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama -->
            <div class="mb-4">
              <label for="nama" class="form-label fw-semibold">Nama</label>
              <input
                type="text"
                class="form-control rounded-3 shadow-sm @error('nama') is-invalid @enderror"
                id="nama"
                name="nama"
                placeholder="Masukkan nama"
                value="{{ old('nama', Auth::user()->name) }}"
                required
              />
              @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4" />

            <!-- NIM -->
            <div class="mb-4">
              <label for="nim" class="form-label fw-semibold">NIM</label>
              <input
                type="text"
                class="form-control rounded-3 shadow-sm @error('nim') is-invalid @enderror"
                id="nim"
                name="nim"
                placeholder="Masukkan NIM"
                value="{{ old('nim', Auth::user()->nim) }}"
                required
              />
              @error('nim')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4" />

            <!-- Email -->
            <div class="mb-4">
              <label for="email" class="form-label fw-semibold">Email</label>
              <input
                type="email"
                class="form-control rounded-3 shadow-sm @error('email') is-invalid @enderror"
                id="email"
                name="email"
                placeholder="contoh@gmail.com"
                value="{{ old('email', Auth::user()->email) }}"
                required
              />
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4" />

            <!-- Nama Perusahaan -->
            <div class="mb-4">
              <label for="perusahaan" class="form-label fw-semibold">Nama Perusahaan</label>
              <input
                type="text"
                class="form-control rounded-3 shadow-sm @error('perusahaan') is-invalid @enderror"
                id="perusahaan"
                name="perusahaan"
                placeholder="Masukkan nama perusahaan"
                value="{{ old('perusahaan') }}"
                required
              />
              @error('perusahaan')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4" />

            <!-- Rencana Pelaksanaan KP -->
            <div class="mb-4">
              <label for="pelaksanaan" class="form-label fw-semibold">Rencana Pelaksanaan KP</label>
              <textarea
                class="form-control rounded-3 shadow-sm @error('pelaksanaan') is-invalid @enderror"
                id="pelaksanaan"
                name="pelaksanaan"
                rows="4"
                placeholder="Masukkan rencana pelaksanaan KP"
                required
              >{{ old('pelaksanaan') }}</textarea>
              @error('pelaksanaan')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4" />

            <!-- Lokasi KP -->
            <div class="mb-4">
              <label for="lokasi" class="form-label fw-semibold">Lokasi KP</label>
              <textarea
                class="form-control rounded-3 shadow-sm @error('lokasi') is-invalid @enderror"
                id="lokasi"
                name="lokasi"
                rows="4"
                placeholder="Masukkan lokasi perusahaan"
                required
              >{{ old('lokasi') }}</textarea>
              @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <hr class="my-4" />

            <!-- Bukti Penerimaan -->
            <div class="mb-4">
              <label for="bukti-penerimaan" class="form-label fw-semibold">Bukti Penerimaan</label>
              <input
                type="file"
                class="form-control rounded-3 shadow-sm @error('bukti-penerimaan') is-invalid @enderror"
                id="bukti-penerimaan"
                name="bukti-penerimaan"
                accept=".pdf,.jpg,.jpeg,.png"
              />
              @error('bukti-penerimaan')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <small class="text-muted">Format: PDF, JPG, JPEG, PNG. Max 2MB.</small>
            </div>

            <div class="text-center mt-4">
              <button
                type="submit"
                class="btn btn-primary rounded-3 px-5 py-2 shadow-lg"
              >
                <i class="fas fa-paper-plane me-2"></i>Submit Form
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<footer class="footer bg-dark text-white mt-auto">
  <div class="container py-4">
    <div class="row justify-content-between align-items-center">
      <div class="col-md-6 d-flex align-items-center">
        <img
          src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png"
          alt="Institut Teknologi Del Logo"
          style="height: 60px; margin-right: 20px"
        />
        <div>
          <h5 class="mb-1">Institut Teknologi Del</h5>
          <p class="mb-0">
            Jl. Sisingamangaraja, Sitoluama<br />
            Laguboti, Toba Samosir, Sumatera Utara<br />
            Indonesia
          </p>
        </div>
      </div>

      <div class="col-md-4 text-end">
        <a
          href="https://www.instagram.com"
          target="_blank"
          class="text-white me-3"
        >
          <i class="fab fa-instagram" style="font-size: 24px"></i>
        </a>
        <a href="tel:+1234567890" class="text-white me-3">
          <i class="fas fa-phone" style="font-size: 24px"></i>
        </a>
        <a href="mailto:info@del.ac.id" class="text-white">
          <i class="fas fa-envelope" style="font-size: 24px"></i>
        </a>
      </div>
    </div>
    <div class="text-center mt-3">
      <small>&copy; 2024 Institut Teknologi Del | All Rights Reserved</small>
    </div>
  </div>
</footer>

<script>
  function showNotifications(event) {
    event.preventDefault();
    alert("You have 3 new notifications!");
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."></script>
</body>
</html>
