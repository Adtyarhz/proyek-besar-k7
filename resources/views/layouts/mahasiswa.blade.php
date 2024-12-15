<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title')</title>
  <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
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

    .navbar .fa-bell {
      color: white;
      font-size: 24px;
      margin-right: 15px;
      /* Jarak antar ikon bel dan profil */
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
      /* Menambahkan warna putih pada toggle icon */
    }

    /* Dropdown Styling */
    .navbar-nav .dropdown-menu {
      background-color: #003366;
    }

    .navbar-nav .dropdown-item {
      color: white;
    }

    .navbar-nav .dropdown-item:hover {
      background-color: #00508b;
    }

    .carousel {
      max-width: 800px;
      margin: 30px auto;
    }

    .carousel img {
      height: 400px;
      object-fit: cover;
      border-radius: 10px;
    }

    .content {
      padding: 60px 20px;
      background-color: #E8F8FF;
      /* Menambahkan warna latar belakang terang */
    }

    .content h2 {
      margin-bottom: 40px;
    }

    .student-count .count-item {
      text-align: center;
      padding: 20px;
      background-color: #f8f9fa;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      margin: 15px;
    }

    .student-count .count-item i {
      font-size: 36px;
      color: #003366;
    }

    .student-count .count-item p {
      margin: 10px 0;
    }

    .container2 {
      max-width: 1200px;
      /* Memperbesar ukuran kontainer */
      margin: auto;
      padding: 20px;
    }

    canvas {
      margin: 20px 0;
      width: 100% !important;
      /* Mengatur lebar chart supaya lebih besar */
      height: 400px !important;
      /* Mengatur tinggi chart */
    }

    h2 {
      text-align: center;
    }

    /* Custom Styling to Ensure Chart Stays Beside Each Other */
    .charts-row {
      display: flex;
      justify-content: space-between;
      gap: 30px;
      /* Memberikan jarak antar chart */
    }

    .chart-container {
      flex: 1;
      padding: 10px;
    }

    .footer {
      background-color: #003366;
      /* Warna biru tua */
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
      /* Efek zoom saat hover */
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
      <a class="navbar-brand" href="
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
        <img alt="Logo" src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png"
          style="height: 50px; margin-right: 10px" />
        <span style="font-size: 24px; color: white; font-weight: bold">PRATIKMA</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
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
          " href="
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMBKM" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
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
        <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile Photo" width="32" height="32"
        class="rounded-circle me-2">
      @endif
              <strong>{{ Auth::user()->name }}</strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow"
              aria-labelledby="dropdownUser">
              <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
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

  @yield('content')

  @include('partials.footer')

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