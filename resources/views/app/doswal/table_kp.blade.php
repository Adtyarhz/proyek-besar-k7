<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabel Eligible KP - Dosen Wali</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    </style>
</head>
<body>
@php
    $user = Auth::user();
    $userRole = $user ? $user->role : null;
@endphp

<nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #0073e6, #003366);">
  <div class="container-fluid">
    <a class="navbar-brand" href="
      @if($userRole === 'Doswal')
          {{ route('home.doswal') }}
      @elseif($userRole === 'Kaprodi')
          {{ route('home.kaprodi') }}
      @elseif($userRole === 'Koordinator')
          {{ route('home.koordinator') }}
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
            @if(in_array(Route::currentRouteName(), ['home', 'home.doswal', 'home.kaprodi', 'home.koordinator']))
              active
            @endif
          " href="
            @if($userRole === 'Doswal')
              {{ route('home.doswal') }}
            @elseif($userRole === 'Kaprodi')
              {{ route('home.kaprodi') }}
            @elseif($userRole === 'Koordinator')
              {{ route('home.koordinator') }}
            @else
              {{ route('home') }}
            @endif
          ">
            Beranda
          </a>
        </li>

        <!-- MBKM Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMBKM" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            MBKM
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMBKM">
          <li><a class="dropdown-item" href="{{ route('doswal.tabelinput_mbkm') }}">Table Pertimbangan MBKM</a></li>
          <li><a class="dropdown-item" href="{{ route('doswal.tabel_mbkm') }}">Table Eligible MBKM</a></li>
          </ul>
        </li>

        <!-- Kerja Praktik Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownKP" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kerja Praktik
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownKP">
            <li>
              <a class="dropdown-item" href="
                @if($userRole === 'Doswal')
                  {{ route('doswal.tabelinputkp') }}
                @elseif($userRole === 'Kaprodi')
                  {{ route('kaprodi.tabelinputkp') }}
                @elseif($userRole === 'Koordinator')
                  {{ route('koordinator.tabelinputkp') }}
                @else
                  #
                @endif
              ">
                Table Pertimbangan KP
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="
                @if($userRole === 'Doswal')
                  {{ route('doswal.tableeligiblekp') }}
                @else
                  #
                @endif
              ">Table Eligible KP</a>
            </li>
          </ul>
        </li>

        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @else
          <li class="nav-item">
            <a href="#" onclick="showNotifications(event)" class="nav-link">
              <i class="fas fa-bell"></i><span class="badge bg-danger">3</span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if($user->profile_photo)
                <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile Photo" width="30" height="30" class="rounded-circle">
              @endif
              {{ $user->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
              <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="#"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

@if(session('success'))
    <div class="alert alert-success text-center mt-3">
        {{ session('success') }}
    </div>
@endif

<div class="container my-5">
  <h2 class="text-center">Daftar Peserta Kerja Praktik (Eligible KP - Newest Data)</h2>
  <table class="table table-bordered table-striped mt-4" id="dataTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Angkatan</th>
        <th>Perusahaan</th>
        <th>Rencana Pelaksanaan</th>
        <th>Lokasi</th>
        <th>Bukti Penerimaan</th>
        <th>Status</th>
        <th>Tanggal Daftar</th>
        <th>Catatan Dosen Wali (Eligible)</th>
        <th>Catatan Kaprodi (Eligible)</th>
        <th>Catatan Koordinator (Eligible)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($pendaftaranKPs as $index => $p)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $p->nama }}</td>
          <td>{{ $p->nim }}</td>
          <td>{{ $p->user->angkatan }}</td>
          <td>{{ $p->perusahaan }}</td>
          <td>{{ $p->pelaksanaan }}</td>
          <td>{{ $p->lokasi }}</td>
          <td>
            @if($p->bukti_penerimaan)
              <a href="{{ asset('storage/' . $p->bukti_penerimaan) }}" target="_blank" class="btn btn-sm btn-primary">
                <i class="fas fa-file-alt"></i> Lihat Bukti
              </a>
            @else
              <span>Belum diunggah</span>
            @endif
          </td>
          <td>
            @if($p->status_pendaftaran == 'Menunggu')
              <span class="badge bg-warning">Menunggu</span>
            @elseif($p->status_pendaftaran == 'Disetujui')
              <span class="badge bg-success">Disetujui</span>
            @elseif($p->status_pendaftaran == 'Ditolak')
              <span class="badge bg-danger">Ditolak</span>
            @endif
          </td>
          <td>{{ $p->created_at->format('d M Y H:i') }}</td>
          <td>
            <!-- Doswal can edit/add catatan_doswal_eligible -->
            <a href="#" class="btn btn-sm btn-secondary" onclick="toggleCatatanForm({{ $p->id }}, 'doswal')">
              @if($p->catatan_doswal_eligible)
                Edit Catatan
              @else
                Add Catatan
              @endif
            </a>
            <div id="form-catatan-doswal-{{ $p->id }}" class="mt-2" style="display: none;">
              <form action="{{ route('doswal.tableeligiblekp.update_catatan', $p->id) }}" method="POST">
                @csrf
                <textarea name="catatan_doswal_eligible" class="form-control" rows="3" required>{{ $p->catatan_doswal_eligible }}</textarea>
                <button type="submit" class="btn btn-primary btn-sm mt-2">Save</button>
              </form>
            </div>
            @if($p->catatan_doswal_eligible)
              <p>{{ $p->catatan_doswal_eligible }}</p>
            @endif
          </td>
          <td>{{ $p->catatan_kaprodi_eligible ?? '-' }}</td>
          <td>{{ $p->catatan_koordinator_eligible ?? '-' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<footer class="footer bg-dark text-white">
  <div class="container py-4">
    <div class="row justify-content-between align-items-center">
      <div class="col-md-6 d-flex align-items-center">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png"
          alt="Institut Teknologi Del Logo" style="height: 60px; margin-right: 20px" />
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

  function toggleCatatanForm(id, role) {
    const form = document.getElementById(`form-catatan-${role}-${id}`);
    if (form.style.display === "none") {
      form.style.display = "block";
    } else {
      form.style.display = "none";
    }
  }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
