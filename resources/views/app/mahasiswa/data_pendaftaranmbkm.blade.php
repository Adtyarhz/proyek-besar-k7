{{-- resources/views/app/mahasiswa/data_pendaftaranmbkm.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Pendaftaran MBKM - PRATIKMA</title>
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
    <style>
        /* CSS yang konsisten dan responsif */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
        .navbar-toggler-icon {
            background-color: white;
        }

        .footer {
            background-color: #003366;
            padding: 20px 0;
            margin-top: auto;
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

        .data-section {
            background: #ffffff;
            padding: 30px 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .data-item {
            margin-bottom: 15px;
        }

        .data-item label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .badge-menunggu {
            background-color: #ffc107;
            color: #000;
        }

        .badge-disetujui {
            background-color: #28a745;
        }

        .badge-ditolak {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
@php
    $user = Auth::user();
    $userRole = $user ? $user->role : null;
@endphp

<nav class="navbar navbar-expand-lg navbar-dark">
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
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <!-- Beranda -->
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

        <!-- MBKM Dropdown -->
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
            <li><a class="dropdown-item" href="{{ route('mbkm_pendaftaran.data') }}">Data Pendaftaran MBKM</a></li>
          </ul>
        </li>

        <!-- Kerja Praktik Dropdown -->
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
          </ul>
        </li>
      </ul>

      <div class="d-flex align-items-center ms-3">
        <!-- Notification Bell -->
        <div class="notification-bell me-3">
          <a href="#" onclick="showNotifications(event)" style="text-decoration: none">
            <i class="fas fa-bell"></i>
            <span class="notification-badge">3</span>
          </a>
        </div>

        <!-- Profile Dropdown -->
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

<!-- Display Success Message -->
@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<!-- Display Error Message -->
@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

<!-- Data Pendaftaran MBKM Section -->
<div class="container my-5">
    <h3 class="text-center mb-4">Data Pendaftaran MBKM</h3>

    @if($pendaftaranMbkm)
        <div class="data-section">
            <div class="data-item">
                <label>Nama:</label>
                <p>{{ $pendaftaranMbkm->nama }}</p>
            </div>
            <div class="data-item">
                <label>NIM:</label>
                <p>{{ $pendaftaranMbkm->nim }}</p>
            </div>
            <div class="data-item">
                <label>Email:</label>
                <p>{{ $pendaftaranMbkm->email }}</p>
            </div>
            <div class="data-item">
                <label>Rencana Pelaksanaan MBKM:</label>
                <p>{{ $pendaftaranMbkm->rencana_pelaksanaan_mbkm }}</p>
            </div>
            <div class="data-item">
                <label>Lokasi MBKM:</label>
                <p>{{ $pendaftaranMbkm->lokasi_mbkm }}</p>
            </div>
            <div class="data-item">
                <label>Bukti Penerimaan MBKM:</label>
                @if($pendaftaranMbkm->bukti_penerimaan_mbkm)
                    <a href="{{ asset('storage/' . $pendaftaranMbkm->bukti_penerimaan_mbkm) }}" target="_blank" class="btn btn-sm btn-primary">
                        <i class="fas fa-file-alt"></i> Lihat Bukti
                    </a>
                @else
                    <span>Belum diunggah</span>
                @endif
            </div>
            <div class="data-item">
                <label>Status Pendaftaran:</label>
                @if($pendaftaranMbkm->status == 'Menunggu' || $pendaftaranMbkm->status == null)
                    <span class="badge badge-menunggu">Menunggu</span>
                @elseif($pendaftaranMbkm->status == 'Disetujui')
                    <span class="badge badge-disetujui">Disetujui</span>
                @elseif($pendaftaranMbkm->status == 'Ditolak')
                    <span class="badge badge-ditolak">Ditolak</span>
                @endif
            </div>

            <!-- Penambahan SKS dari Koordinator -->
            <div class="data-item">
                <label>SKS yang Diberikan:</label>
                @if($pendaftaranMbkm->sks_koordinator)
                    <p>{{ $pendaftaranMbkm->sks_koordinator }} SKS</p>
                @else
                    <span>Belum ada SKS yang ditentukan.</span>
                @endif
            </div>

            <hr class="my-4">
            <h5>Catatan:</h5>
            <div class="data-item">
                <label>Catatan Dosen Wali:</label>
                <p>{{ $pendaftaranMbkm->catatan_dosen_wali ?? 'Belum ada catatan dari Dosen Wali.' }}</p>
            </div>
            <div class="data-item">
                <label>Catatan Kaprodi:</label>
                <p>{{ $pendaftaranMbkm->catatan_kaprodi ?? 'Belum ada catatan dari Kaprodi.' }}</p>
            </div>
            <div class="data-item">
                <label>Catatan Koordinator:</label>
                <p>{{ $pendaftaranMbkm->catatan_koordinator ?? 'Belum ada catatan dari Koordinator.' }}</p>
            </div>
        </div>
    @else
        <p class="text-center">Belum ada data pendaftaran MBKM.</p>
    @endif
</div>

<!-- Footer Section -->
<footer class="footer bg-dark text-white">
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

<!-- JavaScript -->
<script>
  function showNotifications(event) {
    event.preventDefault();
    alert("You have 3 new notifications!");
  }

  function showProfileMenu(event) {
    event.preventDefault();
    alert("Opening profile menu...");
  }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
