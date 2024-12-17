{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register Page</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #eaecef, #666b7d);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 1rem;
            box-sizing: border-box;
            /* memastikan padding tidak merusak layout */
        }

        .container {
            max-width: 1200px;
            width: 100%;
            /* memastikan kontainer tetap responsif */
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
            max-width: 400px;
            /* batas lebar maksimum */
            width: 100%;
            /* memanfaatkan ruang yang tersedia */
            box-sizing: border-box;
            /* memastikan padding tidak merusak layout */
        }

        .form-control {
            margin-bottom: 0.7rem;
            height: 35px;
            width: 100%;
            /* memastikan input memanfaatkan ruang penuh */
            box-sizing: border-box;
        }

        .form-label {
            font-size: 0.85rem;
        }

        .btn-primary {
            height: 36px;
            font-size: 0.9rem;
            font-weight: bold;
            width: 100%;
            /* tombol responsif */
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

        /* Media Queries untuk layar kecil */
        @media (max-width: 768px) {
            .logo h1 {
                font-size: 5rem;
                /* ukuran lebih kecil untuk layar sempit */
            }

            .logo p {
                font-size: 1.2rem;
            }

            .logo-decoration {
                width: 150px;
                /* lebih kecil pada layar kecil */
            }

            .register-container {
                padding: 1rem;
                /* padding lebih kecil */
            }
        }

        @media (max-width: 480px) {
            .logo h1 {
                font-size: 4rem;
            }

            .logo p {
                font-size: 1rem;
            }

            .logo-decoration {
                width: 100px;
            }

            .register-container {
                padding: 0.8rem;
                /* lebih kecil pada layar sangat kecil */
            }
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
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
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
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" placeholder="Enter your username"
                                value="{{ old('username') }}">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
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
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
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
                            <select class="form-control @error('angkatan') is-invalid @enderror" id="angkatan"
                                name="angkatan">
                                <option value="" disabled selected hidden>Select Angkatan</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year->year }}" {{ old('angkatan') == $year->year ? 'selected' : '' }}>
                                        {{ $year->year }}
                                    </option>
                                @endforeach
                            </select>
                            @error('angkatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Dosen Wali -->
                        <div class="mb-1">
                            <label for="doswal" class="form-label">Dosen Wali</label>
                            <select class="form-control @error('doswal') is-invalid @enderror" id="doswal"
                                name="doswal">
                                <option value="" disabled selected hidden>Select Dosen Wali</option>
                                @foreach ($dosenWali as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('doswal') == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->name }} ({{ $dosen->angkatan }})
                                    </option>
                                @endforeach
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
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
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
                            <input type="password" class="form-control @error('confirmPassword') is-invalid @enderror"
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