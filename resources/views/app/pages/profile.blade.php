{{-- resources/views/app/pages/profile.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - PRATIKMA</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
          crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa; /* Light background for better contrast */
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

        /* Profile Section Styling */
        .profile-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-header img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0073e6;
            margin-bottom: 1rem;
        }

        .profile-header h3 {
            margin-bottom: 0.5rem;
        }

        .profile-form .form-group {
            margin-bottom: 1.5rem;
        }

        .profile-form label {
            font-weight: bold;
        }

        .profile-form input[type="file"] {
            padding: 0.5rem 0;
        }

        .profile-form button {
            width: 100%;
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .profile-header img {
                width: 120px;
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
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
              <a class="nav-link active" href="{{ route('home') }}">Beranda</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                MBKM
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li>
                  <a class="dropdown-item" href="home_mbkm.html">Informasi</a>
                </li>
                <li>
                  <a class="dropdown-item" href="formkelayakan_mbkm.html">Form Kelayakan MBKM</a>
                </li>
                <li><a class="dropdown-item" href="formfinal_mbkm.html">Form Final MBKM</a></li>
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
                <li><a class="dropdown-item" href="#">Informasi</a></li>
                <li><a class="dropdown-item" href="formkelayakan_kp.html">Form Kelayakan KP</a></li>
                <li>
                  <a class="dropdown-item" href="formpendaftarnkp.html">Form Pendaftaran KP</a>
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
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                      @csrf
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>

    <!-- Profile Section -->
    <div class="container mt-5">
        <div class="row align-items-center">
            <!-- Logo Section (Visible on Large Screens) -->
            <div class="col-lg-6 text-center d-none d-lg-block">
                <div class="logo">
                    <img
                        alt="PRATIKMA Logo"
                        src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png"
                        class="img-fluid"
                    />
                </div>
            </div>
            <!-- Profile Form Section -->
            <div class="col-lg-6">
                <div class="profile-container">
                    <div class="profile-header">
                        @if($user->profile_photo)
                            <img src="{{ asset('storage/profile_photos/' . $user->profile_photo) }}" alt="Profile Photo">
                        @else
                            <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile Photo">
                        @endif
                        <h3>{{ $user->name }}</h3>
                    </div>
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form" onsubmit="return confirm('Are you sure you want to save changes?');">
                        @csrf

                        <!-- Username -->
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text"
                                   class="form-control @error('username') is-invalid @enderror"
                                   id="username"
                                   name="username"
                                   value="{{ old('username', $user->username) }}"
                                   required>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Current Password -->
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   id="current_password"
                                   name="current_password"
                                   placeholder="Enter your current password">
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   placeholder="Enter your new password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Confirm your new password">
                        </div>

                        <!-- Profile Photo Upload -->
                        <div class="form-group">
                            <label for="profile_photo">Change Profile Photo</label>
                            <input type="file"
                                   class="form-control @error('profile_photo') is-invalid @enderror"
                                   id="profile_photo"
                                   name="profile_photo"
                                   accept="image/*">
                            @error('profile_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Save Button -->
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer bg-dark text-white mt-5">
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

      // The profile dropdown is handled by Bootstrap
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
