<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title')</title>
  <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
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
  <nav class="navbar navbar-expand-lg" style="background: linear-gradient(90deg, #0073e6, #003366);">
    <div class="container">
      @php
    $user = Auth::user();
    $userRole = $user ? $user->role : null;
    @endphp

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
        <img alt="Logo of the institution"
          src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png"
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
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMBKM" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              MBKM
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMBKM">
              <li><a class="dropdown-item" href="{{ route('kaprodi.tabelinput_mbkm') }}">Table Pertimbangan MBKM</a>
              </li>
              <li><a class="dropdown-item" href="{{ route('kaprodi.tabel_mbkm') }}">Table Eligible MBKM</a></li>
            </ul>
          </li>

          <!-- Kerja Praktik Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownKP" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
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
              <li><a class="dropdown-item" href="@if($userRole === 'Kaprodi')
          {{ route('kaprodi.tableeligiblekp') }}
        @else
      #
    @endif">Table Eligible KP</a></li>
            </ul>
          </li>

          @guest
        <li class="nav-item">
        <a class="nav-link" href="{{ route('login.form') }}">Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
      @else



      <!-- Profile Dropdown -->
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        <strong>{{ Auth::user()->name }}</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownUser">
        <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
        <li>
        <hr class="dropdown-divider">
        </li>
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

  @yield('content')

  @include('partials.footer')

  <!-- JavaScript -->
  <script>
    function showProfileMenu(event) {
      event.preventDefault();
      alert("Opening profile menu...");
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>