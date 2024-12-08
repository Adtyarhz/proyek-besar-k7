{{-- resources/views/app/mahasiswa/data_kelayakanmbkm.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Kelayakan MBKM - PRATIKMA</title>
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
        .navbar .fa-bell {
            color: white;
            font-size: 24px;
            margin-right: 15px;
        }
        .navbar .fa-user-circle {
            color: white;
            font-size: 24px;
        }
        .navbar .notification-bell {
            position: relative;
        }
        .navbar .notification-badge {
            position: absolute;
            top: -10px;
            right: -5px;
            background-color: red;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
        }
        .navbar-toggler-icon {
            background-color: white;
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

        /* Responsive Table Styling */
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
@php
    $user = Auth::user();
    $userRole = $user ? $user->role : null;
@endphp

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
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
            <li><a class="dropdown-item" href="{{ route('mbkm_pendaftaran.create') }}">Form Final MBKM</a></li> <!-- Adjust route as needed -->
            <li><a class="dropdown-item" href="{{ route('mbkm.data_kelayakan') }}">Data Kelayakan MBKM</a></li>
            <li><a class="dropdown-item" href="{{ route('mbkm_pendaftaran.data') }}">Data Pendaftaran MBKM</a></li>
          </ul>
        </li>

        <!-- Kerja Praktik Dropdown -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdownKP"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Kerja Praktik
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownKP">
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

<!-- Display Success and Error Messages -->
@if(session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger text-center mt-3">
        {{ session('error') }}
    </div>
@endif

<!-- Data Kelayakan MBKM Section -->
<div class="container my-5">
    <h3 class="text-center mb-4">Data Kelayakan MBKM</h3>
    @forelse($dataKelayakan as $data)
        <div class="data-section">
            <div class="data-item">
                <label>Nilai IPK:</label>
                <p>{{ $data->nilai_ipk }}</p>
            </div>
            <div class="data-item">
                <label>Total SKS Semester 1-6:</label>
                <p>{{ $data->total_sks }}</p>
            </div>
            <div class="data-item">
                <label>SKS Semester 6:</label>
                <p>{{ $data->sks_semester6 }}</p>
            </div>
            <div class="data-item">
                <label>Mata Kuliah Tidak Lulus:</label>
                <p>{{ $data->mata_kuliah_tidak_lulus }}</p>
            </div>
            <div class="data-item">
                <label>Bukti SKS dan IPK:</label>
                @if($data->bukti_sks_ipk)
                    <a href="{{ asset('storage/' . $data->bukti_sks_ipk) }}" target="_blank" class="btn btn-sm btn-primary">
                        <i class="fas fa-file-alt"></i> Lihat Bukti
                    </a>
                @else
                    <span>Belum diunggah</span>
                @endif
            </div>
            <div class="data-item">
                <label>Status Kelayakan:</label>
                @if($data->status_kelayakan == 'Menunggu')
                    <span class="badge badge-menunggu">Menunggu</span>
                @elseif($data->status_kelayakan == 'Disetujui')
                    <span class="badge badge-disetujui">Disetujui</span>
                @elseif($data->status_kelayakan == 'Ditolak')
                    <span class="badge badge-ditolak">Ditolak</span>
                @endif
            </div>

            <!-- Display Catatan from Dosen Wali, Kaprodi, Koordinator -->
            <hr class="my-4">
            <h5>Catatan dari Peran Terkait:</h5>
            <div class="data-item">
                <label>Catatan Dosen Wali:</label>
                <p>{{ $data->catatan_dosen_wali ?? 'Belum ada catatan dari Dosen Wali.' }}</p>
            </div>
            <div class="data-item">
                <label>Catatan Kaprodi:</label>
                <p>{{ $data->catatan_kaprodi ?? 'Belum ada catatan dari Kaprodi.' }}</p>
            </div>
            <div class="data-item">
                <label>Catatan Koordinator:</label>
                <p>{{ $data->catatan_koordinator ?? 'Belum ada catatan dari Koordinator.' }}</p>
            </div>
        </div>
    @empty
        <p class="text-center">Belum ada data Kelayakan MBKM yang diinput.</p>
    @endforelse
</div>

<!-- Footer Section -->
<footer class="footer bg-dark text-white">
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
