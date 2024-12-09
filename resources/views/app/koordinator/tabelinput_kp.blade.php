<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tabel KP - Koordinator</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Tambahkan style tambahan di sini jika diperlukan */
    </style>
</head>
<body>
@php
    $user = Auth::user();
    $userRole = $user ? $user->role : null;
@endphp

<!-- Navbar -->
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
          <li><a class="dropdown-item" href="{{ route('koordinator.tabelinput_mbkm') }}">Table Pertimbangan MBKM</a></li>
          <li><a class="dropdown-item" href="{{ route('koordinator.tabel_mbkm') }}">Table Eligible MBKM</a></li>
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
            <li><a class="dropdown-item" href="@if($userRole === 'Koordinator')
              {{ route('koordinator.tableeligiblekp') }}
            @else
              #
            @endif">Table Eligible KP</a></li>
          </ul>
        </li>

        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
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
              @else
                <img src="{{ asset('images/default_profile.png') }}" alt="Default Profile Photo" width="30" height="30" class="rounded-circle">
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
<h2 class="text-center">Daftar Peserta Kerja Praktik</h2>

<table class="table table-bordered table-striped mt-4" id="dataTable">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Angkatan</th>
            <th>Tahun Mendaftar KP</th>
            <th>Jumlah SKS (Sem 1-5)</th>
            <th>Jumlah SKS (Sem 6)</th>
            <th>Eligible</th>
            <th>Bukti Lampiran</th>
            <th>Status</th>
            <th>Catatan Dosen Wali</th>
            <th>Catatan Kaprodi</th>
            <th>Catatan Koordinator</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kelayakanKPs as $index => $kp)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $kp->user->name }}</td>
                <td>{{ $kp->user->nim }}</td>
                <td>{{ $kp->user->angkatan }}</td>
                <td>{{ $kp->tahun_mendaftar }}</td>
                <td>{{ $kp->total_sks }}</td>
                <td>{{ $kp->sks_semester6 }}</td>
                <td>{{ $kp->mata_kuliah_tidak_lulus ? 'No' : 'Yes' }}</td>
                <td>
                    @if($kp->bukti_sks_ipk)
                        <a href="{{ asset('storage/' . $kp->bukti_sks_ipk) }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fas fa-file-alt"></i> Lihat Lampiran
                        </a>
                    @else
                        <span>Belum diunggah</span>
                    @endif
                </td>
                <td>
                    @if($kp->status_kelayakan == 'Menunggu')
                        <span class="badge bg-warning">Menunggu</span>
                    @elseif($kp->status_kelayakan == 'Disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @elseif($kp->status_kelayakan == 'Ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </td>
                <td>
                    <!-- catatan_doswal modal view -->
                    @if($kp->catatan_doswal)
                        <button class="btn btn-sm btn-info" onclick="showCatatan('{{ $kp->catatan_doswal }}', 'Catatan Dosen Wali')">View Catatan Dosen Wali</button>
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                    <!-- catatan_kaprodi modal view -->
                    @if($kp->catatan_kaprodi)
                        <button class="btn btn-sm btn-info" onclick="showCatatan('{{ $kp->catatan_kaprodi }}', 'Catatan Kaprodi')">View Catatan Kaprodi</button>
                    @else
                        <span>-</span>
                    @endif
                </td>
                <td>
                    <!-- Koordinator can add/edit catatan_koordinator -->
                    <a href="#" class="btn btn-sm btn-secondary" onclick="toggleCatatanForm({{ $kp->id }}, 'koordinator')">
                        @if($kp->catatan_koordinator)
                            Edit Catatan
                        @else
                            Add Catatan
                        @endif
                    </a>
                    <div id="form-catatan-koordinator-{{ $kp->id }}" class="mt-2" style="display: none;">
                        <form action="{{ route('koordinator.tabelinputkp.update_catatan', $kp->id) }}" method="POST">
                            @csrf
                            <textarea name="catatan" class="form-control" rows="3" required>{{ $kp->catatan_koordinator }}</textarea>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Save</button>
                        </form>
                    </div>
                    @if($kp->catatan_koordinator)
                        <p>{{ $kp->catatan_koordinator }}</p>
                    @endif
                </td>
                <td>
                    <!-- Koordinator can change status -->
                    @if($kp->status_kelayakan == 'Menunggu')
                        <button class="btn btn-success btn-sm me-2" onclick="confirmStatusChange({{ $kp->id }}, 'Disetujui')">Accept</button>
                        <button class="btn btn-danger btn-sm" onclick="confirmStatusChange({{ $kp->id }}, 'Ditolak')">Reject</button>
                    @elseif($kp->status_kelayakan == 'Disetujui')
                        <button class="btn btn-success btn-sm" onclick="confirmStatusChange({{ $kp->id }}, 'Ditolak')">Change to Reject</button>
                    @elseif($kp->status_kelayakan == 'Ditolak')
                        <button class="btn btn-danger btn-sm" onclick="confirmStatusChange({{ $kp->id }}, 'Disetujui')">Change to Accept</button>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

<!-- Modal for viewing catatan -->
<div class="modal fade" id="catatanModal" tabindex="-1" aria-labelledby="catatanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="catatanModalLabel">Catatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="catatanTextarea" rows="5" readonly></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
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

    function showProfileMenu(event) {
        event.preventDefault();
        alert("Opening profile menu...");
    }

    function toggleCatatanForm(id, role) {
        const form = document.getElementById(`form-catatan-${role}-${id}`);
        form.style.display = (form.style.display === "none") ? "block" : "none";
    }

    function showCatatan(catatan, title) {
        document.getElementById('catatanModalLabel').innerText = title;
        document.getElementById('catatanTextarea').value = catatan;
        var catatanModal = new bootstrap.Modal(document.getElementById('catatanModal'), {});
        catatanModal.show();
    }

    function confirmStatusChange(id, newStatus) {
        let confirmation = '';
        if (newStatus === 'Disetujui') {
            confirmation = 'Apakah Anda yakin ingin menyetujui aplikasi ini?';
        } else if (newStatus === 'Ditolak') {
            confirmation = 'Apakah Anda yakin ingin menolak aplikasi ini?';
        }

        if (confirm(confirmation)) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/tabelinput_kp_koordinator/${id}/status`;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const tokenInput = document.createElement('input');
            tokenInput.type = 'hidden';
            tokenInput.name = '_token';
            tokenInput.value = csrfToken;
            form.appendChild(tokenInput);

            const statusInput = document.createElement('input');
            statusInput.type = 'hidden';
            statusInput.name = 'status';
            statusInput.value = newStatus;
            form.appendChild(statusInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
