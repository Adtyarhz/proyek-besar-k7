{{-- resources/views/app/doswal/tabel_mbkm.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table Eligible MBKM - PRATIKMA</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        /* Consistent CSS styles */
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

        .badge-menunggu { background-color: #ffc107; color: #000; }
        .badge-disetujui { background-color: #28a745; color: #fff; }
        .badge-ditolak { background-color: #dc3545; color: #fff; }

        /* Responsive table */
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }

        /* Button spacing */
        .btn-group {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
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
          <li><a class="dropdown-item" href="{{ route('doswal.tabelinput_mbkm') }}">Table Pertimbangan MBKM</a></li>
          <li><a class="dropdown-item" href="{{ route('doswal.tabel_mbkm') }}">Table Eligible MBKM</a></li>
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

    <!-- Tabel MBKM Section -->
    <div class="container my-5">
        <h2 class="text-center">Daftar Pendaftaran MBKM</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-4" id="pendaftaranTable">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Email</th>
                        <th>Rencana Pelaksanaan MBKM</th>
                        <th>Lokasi MBKM</th>
                        <th>Bukti Penerimaan</th>
                        <th>Status</th>
                        <th>Catatan Dosen Wali</th>
                        <th>Catatan Kaprodi</th>
                        <th>Catatan Koordinator</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftaranMbkm as $index => $pendaftaran)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pendaftaran->nama }}</td>
                            <td>{{ $pendaftaran->nim }}</td>
                            <td>{{ $pendaftaran->email }}</td>
                            <td>{{ Str::limit($pendaftaran->rencana_pelaksanaan_mbkm, 50, '...') }}</td>
                            <td>{{ $pendaftaran->lokasi_mbkm }}</td>
                            <td>
                                @if($pendaftaran->bukti_penerimaan_mbkm)
                                    <a href="{{ asset('storage/' . $pendaftaran->bukti_penerimaan_mbkm) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-file-alt"></i> Lihat Bukti
                                    </a>
                                @else
                                    <span>Belum diunggah</span>
                                @endif
                            </td>
                            <td>
                                @if($pendaftaran->status == 'Menunggu' || $pendaftaran->status == null)
                                    <span class="badge badge-menunggu">Menunggu</span>
                                @elseif($pendaftaran->status == 'Disetujui')
                                    <span class="badge badge-disetujui">Disetujui</span>
                                @elseif($pendaftaran->status == 'Ditolak')
                                    <span class="badge badge-ditolak">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                {{ $pendaftaran->catatan_dosen_wali ?? 'Belum ada catatan' }}
                                <br>
                                <button type="button" class="btn btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#catatanDoswalModal{{ $pendaftaran->id }}">
                                    @if($pendaftaran->catatan_dosen_wali)
                                        <i class="fas fa-edit"></i> Edit
                                    @else
                                        <i class="fas fa-plus"></i> Tambah
                                    @endif
                                </button>
                            </td>
                            <td>
                                {{ $pendaftaran->catatan_kaprodi ?? 'Belum ada catatan' }}
                                <br>
                                <!-- Kaprodi comments are view-only for Doswal -->
                                @if($pendaftaran->catatan_kaprodi)
                                    <i class="fas fa-eye"></i> Lihat
                                @else
                                    <span>Belum ada catatan</span>
                                @endif
                            </td>
                            <td>
                                {{ $pendaftaran->catatan_koordinator ?? 'Belum ada catatan' }}
                                <br>
                                <!-- Koordinator comments are view-only for Doswal -->
                                @if($pendaftaran->catatan_koordinator)
                                    <i class="fas fa-eye"></i> Lihat
                                @else
                                    <span>Belum ada catatan</span>
                                @endif
                            </td>
                        </tr>

                        {{-- Modal for Adding/Editing Catatan Dosen Wali --}}
                        <div class="modal fade" id="catatanDoswalModal{{ $pendaftaran->id }}" tabindex="-1" aria-labelledby="catatanDoswalModalLabel{{ $pendaftaran->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('doswal.tabel_mbkm.update_catatan', $pendaftaran->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="catatanDoswalModalLabel{{ $pendaftaran->id }}">
                                                @if($pendaftaran->catatan_dosen_wali)
                                                    Edit Catatan Dosen Wali
                                                @else
                                                    Tambah Catatan Dosen Wali
                                                @endif
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="catatan_dosen_wali{{ $pendaftaran->id }}" class="form-label">Catatan Dosen Wali</label>
                                                <textarea name="catatan_dosen_wali" class="form-control" id="catatan_dosen_wali{{ $pendaftaran->id }}" rows="3" required>{{ old('catatan_dosen_wali', $pendaftaran->catatan_dosen_wali) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">
                                                @if($pendaftaran->catatan_dosen_wali)
                                                    Simpan Perubahan
                                                @else
                                                    Simpan
                                                @endif
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">Belum ada data Pendaftaran MBKM yang diinput.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="footer bg-dark text-white">
        <div class="container py-4">
            <div class="row justify-content-between align-items-center">
                <!-- Left Side: Logo and Address -->
                <div class="col-md-6 d-flex align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" alt="Institut Teknologi Del Logo" style="height: 60px; margin-right: 20px" />
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
            alert("You have 3 new notifications!");
        }

        function showProfileMenu(event) {
            event.preventDefault();
            alert("Opening profile menu...");
        }
    </script>

    <!-- Bootstrap JS (for modal functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
