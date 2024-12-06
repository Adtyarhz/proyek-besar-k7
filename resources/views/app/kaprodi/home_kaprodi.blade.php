<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Informasi MBKM</title>
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
    <link
      crossorigin="anonymous"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      rel="stylesheet"
    />
    <style>
      html,
      body {
        height: 100%; /* Membuat tinggi halaman 100% */
        margin: 0; /* Menghapus margin default */
        display: flex; /* Menjadikan layout menggunakan flexbox */
        flex-direction: column; /* Mengatur layout secara vertikal */
      }
      body {
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
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
        margin-right: 15px; /* Jarak antar ikon bel dan profil */
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
        background-color: white; /* Menambahkan warna putih pada toggle icon */
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
        flex-grow: 1; /* Konten akan mengisi sisa ruang yang tersedia */
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
        background-color: #003366; /* Warna biru tua */
        padding: 20px 0;
        margin-top: auto; /* Menjaga footer tetap berada di bawah */
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
        transform: scale(1.2); /* Efek zoom saat hover */
      }

      .footer small {
        color: #aaaaaa;
        font-size: 12px;
      }
      .info-section {
        background: linear-gradient(
          to bottom,
          #e6f7ff,
          #ffffff
        ); /* Gradien halus */
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
  <div class="container-fluid">
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
      <img
        alt="Logo of the institution"
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
            <li><a class="dropdown-item" href="#">Table Eligible MBKM</a></li>
            <li><a class="dropdown-item" href="#">Table Pertimbangan MBKM</a></li>
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
                Table Eligible KP
              </a>
            </li>
            <li><a class="dropdown-item" href="#">Table Pertimbangan KP</a></li>
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
          <!-- Notification Bell -->
          <li class="nav-item">
            <a href="#" onclick="showNotifications(event)" class="nav-link">
              <i class="fas fa-bell"></i>
              <span class="badge bg-danger">3</span>
            </a>
          </li>

          <!-- Profile Dropdown -->
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

    <!-- Information Section -->
    <div class="info-section bg-light py-5">
      <div class="container" style="margin-top: 50px">
        <!-- Header Section -->
        <div
          class="container d-flex align-items-center justify-content-center mb-4"
          style="flex-wrap: nowrap"
        >
          <!-- Gambar -->
          <div class="me-4">
            <img
              alt="Kampus Merdeka Indonesia Jaya logo"
              height="100"
              src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Logo_Kampus_Merdeka_Kemendikbud.png/800px-Logo_Kampus_Merdeka_Kemendikbud.png"
              class="img-fluid"
            />
          </div>
          <!-- Teks -->
          <div>
            <p
              class="text-muted mb-0"
              style="font-size: 20px; max-width: 600px"
            >
              Merdeka Belajar Kampus Merdeka (MBKM) adalah kebijakan yang
              dicanangkan oleh Kementerian Pendidikan, Kebudayaan, Riset, dan
              Teknologi (Kemendikbudristek) Indonesia. MBKM menawarkan berbagai
              program yang memungkinkan mahasiswa untuk mengembangkan
              keterampilan sesuai dengan minat dan bakat mereka, serta
              memperoleh pengalaman praktis di luar kampus.
            </p>
          </div>
        </div>
        <br />
        <hr class="divider mb-5" style="border-top: 6px solid #f89b21" />

        <!-- Info Boxes Section -->
        <div class="row">
          <div class="col-md-6 mb-4">
            <div class="info-box shadow p-4 h-100 bg-white rounded">
              <div class="text-center mb-3">
                <i class="fas fa-handshake fa-3x text-primary"></i>
              </div>
              <h5 class="text-center" style="color: #003366">MBKM Mitra</h5>
              <p class="text-muted">
                MBKM Mitra adalah program yang dilaksanakan oleh perguruan
                tinggi bekerja sama dengan mitra eksternal yang telah disetujui
                atau didaftarkan oleh Kemendikbudristek. Mitra eksternal ini
                bisa berupa perusahaan, organisasi, startup, lembaga pemerintah,
                atau institusi lainnya yang telah menjalin kerja sama resmi
                dengan universitas atau Kemendikbudristek.
              </p>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="info-box shadow p-4 h-100 bg-white rounded">
              <div class="text-center mb-3">
                <i class="fas fa-briefcase fa-3x text-success"></i>
              </div>
              <h5 class="text-center" style="color: #003366">MBKM Non Mitra</h5>
              <p class="text-muted">
                MBKM Non Mitra adalah program yang tidak secara langsung
                difasilitasi oleh mitra resmi yang terdaftar di
                Kemendikbudristek. Namun, mahasiswa dapat memilih untuk magang
                atau terlibat dalam proyek yang diselenggarakan oleh organisasi
                atau perusahaan yang tidak memiliki kerja sama formal dengan
                kampus atau Kemendikbudristek.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Tujuan Section -->
    <div class="header">
      <h2>Tujuan MBKM</h2>
      <div class="row">
        <div class="col-md-4">
          <p>
            1. Meningkatkan kompetensi lulusan sehingga mahasiswa memiliki
            keterampilan yang siap kerja.
          </p>
        </div>
        <div class="col-md-4">
          <p>
            2. Mendorong pembelajaran fleksibel dengan memfasilitasi mahasiswa
            untuk mengambil pembelajaran di luar program studi atau di luar
            kampus.
          </p>
        </div>
        <div class="col-md-4">
          <p>
            3. Meningkatkan daya saing lulusan melalui pengalaman kerja nyata.
          </p>
        </div>
      </div>
    </div>
    <br />
    <h3 class="text-center">Beberapa contoh Mitra dan Non Mitra</h3>
    <div class="content">
      <div
        class="carousel slide"
        data-bs-ride="carousel"
        id="carouselExampleIndicators"
      >
        <div class="carousel-indicators">
          <button
            aria-current="true"
            aria-label="Slide 1"
            class="active"
            data-bs-slide-to="0"
            data-bs-target="#carouselExampleIndicators"
            type="button"
          ></button>
          <button
            aria-label="Slide 2"
            data-bs-slide-to="1"
            data-bs-target="#carouselExampleIndicators"
            type="button"
          ></button>
          <button
            aria-label="Slide 3"
            data-bs-slide-to="2"
            data-bs-target="#carouselExampleIndicators"
            type="button"
          ></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img
              alt="Illustration of a modern city with buildings and trees"
              class="d-block w-100"
              height="400"
              src="https://i.ytimg.com/vi/GqEsw_losvE/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLDgK60mad6TCYEPASbfqlyKscWO_A"
              width="600"
            />
          </div>
          <div class="carousel-item">
            <img
              alt="Illustration of a modern city with buildings and trees"
              class="d-block w-100"
              height="400"
              src="https://awsimages.detik.net.id/visual/2020/10/07/penghargaan-best-companies-to-work-for-yang-diterima-tokopedia-diberikan-atas-penilaian-karyawan-berdasarkan-metode-survei-tot-2_169.jpeg?w=650"
              width="600"
            />
          </div>
          <div class="carousel-item">
            <img
              alt="Illustration of a modern city with buildings and trees"
              class="d-block w-100"
              height="400"
              src="https://cdn0-production-images-kly.akamaized.net/LcyJlUBCIAy_fKJ7C_-GyWy6p1w=/800x450/smart/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/956582/original/095526500_1439608365-Telkom.jpg"
              width="600"
            />
          </div>
        </div>
        <button
          class="carousel-control-prev"
          data-bs-slide="prev"
          data-bs-target="#carouselExampleIndicators"
          type="button"
        >
          <span aria-hidden="true" class="carousel-control-prev-icon"> </span>
          <span class="visually-hidden"> Previous </span>
        </button>
        <button
          class="carousel-control-next"
          data-bs-slide="next"
          data-bs-target="#carouselExampleIndicators"
          type="button"
        >
          <span aria-hidden="true" class="carousel-control-next-icon"> </span>
          <span class="visually-hidden"> Next </span>
        </button>
      </div>
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
        <!-- Footer Bottom Text -->
        <div class="text-center mt-3">
          <small
            >&copy; 2024 Institut Teknologi Del | All Rights Reserved</small
          >
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
