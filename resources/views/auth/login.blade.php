{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Page</title>
    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/e/e2/Del_Institute_of_Technology_Logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background: linear-gradient(to right, #eaecef, #666B7D);
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
            /* Mengurangi padding agar tetap proporsional */
        }

        .logo h1 {
            font-size: 7rem;
            /* Membesarkan ukuran teks */
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .logo p {
            font-size: 1.5rem;
            /* Membesarkan teks deskripsi */
            color: #555;
        }

        .logo .highlight {
            color: #1E90FF;
        }

        .logo-decoration {
            width: 200px;
            /* Memperbesar dekorasi agar proporsional */
            height: 15px;
            background-color: #1E90FF;
            border-radius: 10px;
            margin: 20px auto;
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .form-control {
            margin-bottom: 1.5rem;
            height: 45px;
        }

        .btn-primary {
            height: 45px;
            font-size: 1rem;
            font-weight: bold;
        }

        .login-container a {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #007bff;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        @media (max-width: 991.98px) {
            .logo h1 {
                font-size: 5rem;
                /* Ukuran lebih kecil untuk layar kecil */
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
            <!-- Login Section -->
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="login-container">
                    <form method="POST" action="{{ route('post.login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" id="username" placeholder="Enter your username"
                                value="{{ old('username') }}">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Enter your password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary w-100">
                                Log In
                            </button>
                        </div>

                        <a href="{{ route('register') }}">Create an Account</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>