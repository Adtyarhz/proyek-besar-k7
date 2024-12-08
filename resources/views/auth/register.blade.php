{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Page</title>
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
      body {
        background: linear-gradient(to right, #eaecef, #666b7d);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
      }

      .container {
        max-width: 1200px;
      }

      .logo {
        text-align: center;
        padding: 2rem;
      }

      .logo h1 {
        font-size: 7rem;
        font-weight: bold;
        margin-bottom: 1rem;
      }

      .logo p {
        font-size: 1.5rem;
        color: #555;
      }

      .logo .highlight {
        color: #1e90ff;
      }

      .logo-decoration {
        width: 200px;
        height: 15px;
        background-color: #1e90ff;
        border-radius: 10px;
        margin: 20px auto;
      }

      .register-container {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
      }

      .form-control {
        margin-bottom: 0.7rem;
        height: 35px;
      }

      .form-label {
        font-size: 0.85rem; /* Perkecil ukuran label */
      }

      .btn-primary {
        height: 36px;
        font-size: 0.9rem;
        font-weight: bold;
      }

      .register-container a {
        display: block;
        text-align: center;
        margin-top: 1rem;
        color: #007bff;
        text-decoration: none;
        font-size: 0.85rem;
      }

      .register-container a:hover {
        text-decoration: underline;
      }
    </style>
</head>

<body>
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-lg-6 text-center">
                <div class="logo">
                    <h1>PRAT<span class="highlight">IKMA</span></h1>
                    <p>Platform Kerja Praktik dan MBKM Informatika</p>
                    <div class="logo-decoration"></div>
                </div>
            </div>
            <!-- Register Section -->
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="register-container">
                    <form method="POST" action="{{ route('post.register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-1">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Enter your name" value="{{ old('name') }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div class="mb-1">
                            <label for="username" class="form-label">Username</label>
                            <input type="text"
                                class="form-control @error('username') is-invalid @enderror" id="username"
                                name="username" placeholder="Enter your username" value="{{ old('username') }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="Enter your email" value="{{ old('email') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- NIM -->
                        <div class="mb-1">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text"
                                class="form-control @error('nim') is-invalid @enderror" id="nim"
                                name="nim" placeholder="Enter your NIM" value="{{ old('nim') }}">
                            @error('nim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Angkatan -->
                        <div class="mb-1">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="text"
                                class="form-control @error('angkatan') is-invalid @enderror" id="angkatan"
                                name="angkatan" placeholder="Enter your batch year" value="{{ old('angkatan') }}">
                            @error('angkatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Dosen Wali -->
                        <div class="mb-1">
                            <label for="doswal" class="form-label">Dosen Wali</label>
                            <select
                                class="form-control @error('doswal') is-invalid @enderror"
                                id="doswal" name="doswal">
                                <option value="" disabled selected hidden>Select Dosen Wali</option>
                                <option value="dosen1" {{ old('doswal') == 'dosen1' ? 'selected' : '' }}>
                                    Dr. Arlinta Christy Barus S.T., M.InfoTech (Dosen wali IF 1 angkatan 2022)
                                </option>
                                <option value="dosen2" {{ old('doswal') == 'dosen2' ? 'selected' : '' }}>
                                    Iustisia Natalia Simbolon, S.Kom.,M.T (Dosen wali IF 2 angkatan 2022)
                                </option>
                                <option value="dosen3" {{ old('doswal') == 'dosen3' ? 'selected' : '' }}>
                                    Herimanto, S.Kom., M.Kom (Dosen wali IF 1 angkatan 2023)
                                </option>
                                <option value="dosen4" {{ old('doswal') == 'dosen4' ? 'selected' : '' }}>
                                    Dr. Johannes Harungguan Sianipar, S.T., M.T. (Dosen wali IF 2 angkatan 2023)
                                </option>
                                <option value="dosen5" {{ old('doswal') == 'dosen5' ? 'selected' : '' }}>
                                    Ranty Deviana Siahaan, S.Kom, M.Eng. (Dosen wali IF 1 angkatan 2024)
                                </option>
                                <option value="dosen6" {{ old('doswal') == 'dosen6' ? 'selected' : '' }}>
                                    Jaya Santoso, S.Si.,M.Si. (Dosen wali IF 2 angkatan 2024)
                                </option>
                            </select>
                            @error('doswal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-1">
                            <label for="password" class="form-label">Password</label>
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Enter your password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-1">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password"
                                class="form-control @error('confirmPassword') is-invalid @enderror"
                                id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
                            @error('confirmPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary w-100">
                            Register
                        </button>

                        <!-- Login Link -->
                        <a href="{{ route('login') }}">
                            Already have an account? Log In
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
