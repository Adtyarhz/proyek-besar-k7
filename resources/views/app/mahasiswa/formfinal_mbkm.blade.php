{{-- resources/views/app/mahasiswa/formfinal_mbkm.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran MBKM - PRATIKMA</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* CSS Kustomisasi */
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
        .navbar-nav .nav-link.active {
            font-weight: bold;
        }
        .footer {
            background-color: #003366;
            color: white;
            padding: 20px 0;
        }
        .footer a {
            color: white;
            margin-right: 10px;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @php
        $user = Auth::user();
        $userRole = $user ? $user->role : null;
    @endphp

    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home.mahasiswa') }}">
          <img alt="Logo" src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
          <span style="font-size: 24px; font-weight: bold;">PRATIKMA</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" style="background-color: white;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <!-- Beranda -->
            <li class="nav-item">
              <a class="nav-link @if(Route::currentRouteName() === 'home.mahasiswa') active @endif" 
                 href="{{ route('home.mahasiswa') }}">Beranda</a>
            </li>
            <!-- MBKM Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMBKM" role="button" 
                 data-bs-toggle="dropdown" aria-expanded="false">MBKM</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMBKM">
                <li><a class="dropdown-item" href="{{ route('mbkm.informasi') }}">Informasi</a></li>
                <li><a class="dropdown-item" href="{{ route('mbkm.formkelayakan') }}">Form Kelayakan MBKM</a></li>
                <li><a class="dropdown-item" href="{{ route('mbkm_pendaftaran.create') }}">Form Final MBKM</a></li>
                <li><a class="dropdown-item" href="{{ route('mbkm.data_kelayakan') }}">Data Kelayakan MBKM</a></li>
                <li><a class="dropdown-item" href="{{ route('mbkm_pendaftaran.data') }}">Data Pendaftaran MBKM</a></li>
              </ul>
            </li>
            <!-- Kerja Praktik Dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownKP" role="button" 
                 data-bs-toggle="dropdown" aria-expanded="false">Kerja Praktik</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownKP">
                <li><a class="dropdown-item" href="{{ route('kp.informasi') }}">Informasi</a></li>
                <li><a class="dropdown-item" href="{{ route('kp.formkelayakan') }}">Form Kelayakan KP</a></li>
                <li><a class="dropdown-item" href="{{ route('kp.formpendaftaran') }}">Form Pendaftaran KP</a></li>
                <li><a class="dropdown-item" href="{{ route('kp.data_kelayakan') }}">Data Kelayakan KP</a></li>
                <li><a class="dropdown-item" href="{{ route('kp.data_pendaftaran') }}">Data Pendaftaran KP</a></li>
              </ul>
            </li>
          </ul>
          <!-- Profile Dropdown -->
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" 
               id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
              @if($user->profile_photo)
                <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile Photo" 
                     width="32" height="32" class="rounded-circle me-2">
              @else
                <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile Photo" 
                     width="32" height="32" class="rounded-circle me-2">
              @endif
              <strong>{{ $user->name }}</strong>
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
    </nav>

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
            <div
              class="card-header text-white text-center py-4 rounded-top"
              style="
                background: linear-gradient(90deg, #0073e6, #003366);
                font-size: 24px;
                font-weight: bold;
              "
            >
              <i class="fas fa-check-circle me-2"></i>
              Form Submit Dokumen Final MBKM
            </div>

            <!-- Body -->
            <div
              class="card-body p-5"
              style="
                background-image: url('https://www.transparenttextures.com/patterns/light-paper-fibers.png');
                background-color: #f9f9f9;
              "
            >
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
                  <textarea class="form-control" id="rencana_pelaksanaan_mbkm" name="rencana_pelaksanaan_mbkm" rows="4" required>{{ old('rencana_pelaksanaan_mbkm') }}</textarea>
                  @error('rencana_pelaksanaan_mbkm')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Lokasi MBKM -->
                <div class="mb-3">
                  <label for="lokasi_mbkm" class="form-label fw-semibold">Lokasi MBKM</label>
                  <input type="text" class="form-control" id="lokasi_mbkm" name="lokasi_mbkm" value="{{ old('lokasi_mbkm') }}" required>
                  @error('lokasi_mbkm')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Bukti Penerimaan MBKM -->
                <div class="mb-4">
                  <label for="bukti_penerimaan_mbkm" class="form-label fw-semibold">Bukti Penerimaan MBKM</label>
                  <input
                    type="file"
                    class="form-control rounded-3 shadow-sm"
                    id="bukti_penerimaan_mbkm"
                    name="bukti_penerimaan_mbkm"
                    accept=".pdf,.jpg,.jpeg,.png"
                  />
                  @error('bukti_penerimaan_mbkm')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <!-- Divider -->
                <hr class="my-4" />

                <!-- Submit Button -->
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

    <!-- Footer Section -->
    <footer class="footer bg-dark text-white mt-auto">
      <div class="container py-4">
        <div class="row justify-content-between align-items-center">
          <!-- Left Side: Logo and Address -->
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

          <!-- Right Side: Social Media and Contact -->
          <div class="col-md-4 text-end">
            <a href="https://www.instagram.com" target="_blank" class="text-white me-3">
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
        <!-- Footer Bottom Text -->
        <div class="text-center mt-3">
          <small>&copy; 2024 Institut Teknologi Del | All Rights Reserved</small>
        </div>
      </div>
    </footer>

    <!-- JavaScript -->
    <script>
      function showNotifications(event) {
        event.preventDefault();
        alert("Anda memiliki 3 notifikasi baru!");
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
