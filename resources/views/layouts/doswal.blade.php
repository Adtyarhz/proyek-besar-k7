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

    .header {
      background: linear-gradient(to right, #6ba3d6, #4a90e2);
      color: white;
      padding: 40px 20px;
      text-align: center;
      border-radius: 10px;
      margin: 20px;
    }

    .header h2 {
      font-size: 2.5rem;
      margin-bottom: 20px;
    }

    .header p {
      font-size: 1.1rem;
    }

    .content {
      padding: 20px;
      text-align: center;
      margin: 20px;
      flex-grow: 1;
      /* Konten akan mengisi sisa ruang yang tersedia */
    }

    .carousel {
      max-width: 600px;
      margin: 0 auto;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .carousel img {
      max-width: 100%;
      height: auto;
    }

    .footer {
      background-color: #003366;
      /* Warna biru tua */
      padding: 20px 0;
      margin-top: auto;
      /* Menjaga footer tetap berada di bawah */
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

    .info-section {
      background: linear-gradient(to bottom,
          #e6f7ff,
          #ffffff);
      /* Gradien halus */
      padding: 50px 0;
    }

    .info-box {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .info-box:hover {
      transform: translateY(-5px);
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    }

    .info-box h5 {
      font-weight: bold;
      margin-bottom: 15px;
      font-size: 18px;
    }

    .info-box p {
      font-size: 14px;
      line-height: 1.6;
    }

    .img-fluid {
      max-width: 75%;
      height: auto;
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
              <li><a class="dropdown-item" href="{{ route('doswal.tabelinput_mbkm') }}">Table Pertimbangan MBKM</a></li>
              <li><a class="dropdown-item" href="{{ route('doswal.tabel_mbkm') }}">Table Eligible MBKM</a></li>
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
              <li><a class="dropdown-item" href="@if($userRole === 'Doswal')
          {{ route('doswal.tableeligiblekp') }}
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