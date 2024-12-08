<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Table Kelayakan MBKM - Koordinator</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Tambahkan ini -->
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
        /* Custom Styles */
        .badge-menunggu {
            background-color: #ffc107;
            color: #000;
        }

        .badge-disetujui {
            background-color: #28a745;
            color: #fff;
        }

        .badge-ditolak {
            background-color: #dc3545;
            color: #fff;
        }

        /* Adjust textarea width */
        .catatan-textarea {
            width: 100%;
            resize: none;
        }

        /* Responsive table */
        @media (max-width: 768px) {
            table thead {
                display: none;
            }

            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 15px;
            }

            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                text-align: left;
                font-weight: bold;
            }
        }

        /* Highlight selected row */
        tr.selected {
            background-color: #f1f1f1;
        }

        /* Hide save button initially */
        .save-button {
            display: none;
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

        /* Additional Styles */
        html,
        body {
            height: 100%; /* Full page height */
            margin: 0; /* Remove default margin */
            display: flex; /* Use flexbox layout */
            flex-direction: column; /* Vertical layout */
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
        }
        .navbar-dark .navbar-toggler-icon {
            /* Ensures the toggler icon is visible against dark background */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #0073e6, #003366);">
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
          <span class="navbar-toggler-icon"></span>
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
                <li><a class="dropdown-item" href="{{ route('koordinator.tabel_mbkm') }}">Table Eligible MBKM</a></li> <!-- Ubah href sesuai rute yang benar -->
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
                <li>
                  <a class="dropdown-item" href="
                    @if($userRole === 'Koordinator')
                      {{ route('koordinator.tableeligiblekp') }}
                    @else
                      #
                    @endif
                  ">
                    Table Eligible KP
                  </a>
                </li>
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

    <!-- Alert Messages -->
    <div class="container mt-4">
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
    </div>

    <!-- Tabel Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Daftar Peserta MBKM</h2>

        <table class="table table-bordered table-striped" id="dataTable">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Angkatan</th>
                    <th>Nilai IPK</th>
                    <th>Total SKS (Sem 1-6)</th>
                    <th>Mata Kuliah Tidak Lulus</th>
                    <th>Bukti Lampiran</th>
                    <th>Status</th>
                    <th>Catatan Dosen Wali</th>
                    <th>Catatan Kaprodi</th>
                    <th>Catatan Koordinator</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelayakanMBKMs as $index => $mbkm)
                    <tr id="row-{{ $mbkm->id }}" data-catatan-koordinator="{{ htmlspecialchars($mbkm->catatan_koordinator) }}">
                        <td data-label="No">{{ $index + 1 }}</td>
                        <td data-label="Nama">{{ $mbkm->user->name }}</td>
                        <td data-label="NIM">{{ $mbkm->user->nim }}</td>
                        <td data-label="Angkatan">{{ $mbkm->user->angkatan }}</td>
                        <td data-label="Nilai IPK">{{ $mbkm->nilai_ipk }}</td>
                        <td data-label="Total SKS (Sem 1-6)">{{ $mbkm->total_sks }}</td>
                        <td data-label="Mata Kuliah Tidak Lulus">{{ $mbkm->mata_kuliah_tidak_lulus }}</td>
                        <td data-label="Bukti Lampiran">
                            @if($mbkm->bukti_sks_ipk)
                                <a href="{{ asset('storage/' . $mbkm->bukti_sks_ipk) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fas fa-file-alt"></i> Lihat Lampiran
                                </a>
                            @else
                                <span>Belum diunggah</span>
                            @endif
                        </td>
                        <td data-label="Status">
                            @if($mbkm->status_kelayakan == 'Menunggu')
                                <span class="badge badge-menunggu">Menunggu</span>
                            @elseif($mbkm->status_kelayakan == 'Disetujui')
                                <span class="badge badge-disetujui">Disetujui</span>
                            @elseif($mbkm->status_kelayakan == 'Ditolak')
                                <span class="badge badge-ditolak">Ditolak</span>
                            @endif
                        </td>
                        <td data-label="Catatan Dosen Wali">
                            @if($mbkm->catatan_dosen_wali)
                                <button class="btn btn-sm btn-info" onclick="showCatatan('{{ addslashes($mbkm->catatan_dosen_wali) }}', 'Catatan Dosen Wali')">View</button>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td data-label="Catatan Kaprodi">
                            @if($mbkm->catatan_kaprodi)
                                <button class="btn btn-sm btn-info" onclick="showCatatan('{{ addslashes($mbkm->catatan_kaprodi) }}', 'Catatan Kaprodi')">View</button>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td data-label="Catatan Koordinator">
                            <form action="{{ route('koordinator.tabelinput_mbkm.update_catatan', $mbkm->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <textarea class="form-control catatan-textarea" name="catatan_koordinator" readonly>{{ $mbkm->catatan_koordinator }}</textarea>
                                <button type="button" class="btn btn-sm btn-secondary mt-2 edit-comment" onclick="editComment({{ $mbkm->id }})">Edit</button>
                                <button type="submit" class="btn btn-sm btn-success mt-2 save-comment save-button" style="display: none;">Save</button>
                            </form>
                        </td>
                        <td data-label="Aksi">
                            <form action="{{ route('koordinator.tabelinput_mbkm.update_status', $mbkm->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <select name="status_kelayakan" class="form-select form-select-sm" onchange="this.form.submit()">
                                    <option value="Menunggu" {{ $mbkm->status_kelayakan == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Disetujui" {{ $mbkm->status_kelayakan == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="Ditolak" {{ $mbkm->status_kelayakan == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal for Viewing Comments -->
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

        <!-- Footer Section -->
        <footer class="footer bg-dark text-white mt-auto">
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

        <!-- Bootstrap JS Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-V7oW2UsFq25e/4Irz0xHRv5kTyvT8r7ef6hl0N/IV6Gf0ZbAd1AJMcyPX6PJ3NRo" crossorigin="anonymous"></script>
        
        <!-- Custom JavaScript -->
        <script>
            /**
             * Function to display the catatan (comments) in a modal.
             * @param {string} catatan - The comment text.
             * @param {string} title - The title of the modal.
             */
            function showCatatan(catatan, title) {
                document.getElementById('catatanModalLabel').innerText = title;
                document.getElementById('catatanTextarea').value = catatan;
                var catatanModal = new bootstrap.Modal(document.getElementById('catatanModal'), {});
                catatanModal.show();
            }

            /**
             * Function to edit the Koordinator's comment in the table.
             * @param {number} id - The ID of the MBKM entry.
             */
            function editComment(id) {
                // Enable the textarea and show the save button
                const textarea = document.querySelector(`#row-${id} .catatan-textarea`);
                const editButton = document.querySelector(`#row-${id} .edit-comment`);
                const saveButton = document.querySelector(`#row-${id} .save-button`);

                textarea.readOnly = false;
                textarea.classList.add('bg-light'); // Indicate editable
                editButton.style.display = 'none';
                saveButton.style.display = 'inline-block';
            }

            /**
             * Function to save the edited Koordinator's comment.
             * @param {number} id - The ID of the MBKM entry.
             */
            function saveComment(id) {
                const textarea = document.querySelector(`#row-${id} .catatan-textarea`);
                const newComment = textarea.value.trim();

                if(newComment === '') {
                    alert('Catatan tidak boleh kosong.');
                    return;
                }

                // Submit the form
                const form = textarea.closest('form');
                form.submit();
            }

            /**
             * Function to toggle the status between Accept and Reject.
             * @param {number} id - The ID of the MBKM entry.
             * @param {string} currentStatus - The current status of the MBKM entry.
             */
            function toggleStatus(id, currentStatus) {
                let newStatus = '';
                let button = document.querySelector(`#row-${id} .btn-toggle-status`);

                if (currentStatus === 'Menunggu') {
                    newStatus = 'Disetujui';
                    button.textContent = 'Reject';
                    button.classList.remove('btn-success');
                    button.classList.add('btn-danger');
                } else if (currentStatus === 'Disetujui') {
                    newStatus = 'Ditolak';
                    button.textContent = 'Accept';
                    button.classList.remove('btn-danger');
                    button.classList.add('btn-success');
                } else if (currentStatus === 'Ditolak') {
                    newStatus = 'Disetujui';
                    button.textContent = 'Reject';
                    button.classList.remove('btn-success');
                    button.classList.add('btn-danger');
                }

                if (newStatus) {
                    if (confirm(`Apakah Anda yakin ingin mengubah status MBKM ini menjadi ${newStatus}?`)) {
                        // Submit the form
                        const form = button.closest('form');
                        form.querySelector('select[name="status_kelayakan"]').value = newStatus;
                        form.submit();
                    } else {
                        // Revert button text and classes if canceled
                        if (newStatus === 'Disetujui') {
                            button.textContent = 'Accept';
                            button.classList.remove('btn-danger');
                            button.classList.add('btn-success');
                        } else if (newStatus === 'Ditolak') {
                            button.textContent = 'Reject';
                            button.classList.remove('btn-success');
                            button.classList.add('btn-danger');
                        }
                    }
                }
            }

            /**
             * Function to show the notifications (placeholder).
             */
            function showNotifications(event) {
                event.preventDefault();
                alert("Anda memiliki 3 notifikasi baru!");
            }
        </script>
    </div>

    <!-- Note: Removed the duplicate Bootstrap JS Bundle inclusion -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
