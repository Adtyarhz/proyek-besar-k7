{{-- resources/views/pages/navbar.blade.php --}}
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="{{ route('mahasiswa.dashboard') }}">
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
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="{{ route('mahasiswa.dashboard') }}">Beranda</a>
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
            <li>
              <a class="dropdown-item" href="#">Informasi</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Form Kelayakan MBKM</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Form Final MBKM</a>
            </li>
          </ul>
        </li>
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
              <a class="dropdown-item" href="#">Informasi</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Form Kelayakan KP</a>
            </li>
            <li>
              <a class="dropdown-item" href="#">Form Pendaftaran KP</a>
            </li>
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
        <!-- Profile Icon -->
        <a href="#" onclick="showProfileMenu(event)" style="text-decoration: none">
          <i class="fas fa-user-circle"></i>
        </a>
      </div>
    </div>
  </div>
</nav>
