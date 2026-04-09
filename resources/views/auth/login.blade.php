<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login Perpustakaan | Digital Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('assetsbackend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-dark-deep: #0f1116; /* Hitam lebih pekat */
            --bg-card: #191c24;      /* Warna card template */
            --primary-accent: #00d2ff; /* Warna aksen modern */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark-deep);
            color: #e4e6eb;
            overflow-x: hidden;
        }

        /* Dekorasi Buku Transparan di Background */
        .bg-decoration {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 40rem;
            color: rgba(255, 255, 255, 0.02);
            z-index: -1;
        }

        .login-card {
            background-color: var(--bg-card) !important;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand-logo {
            background: linear-gradient(135deg, var(--primary-accent), #3a7bd5);
            width: 60px;
            height: 60px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            margin-bottom: 15px;
            font-size: 28px;
            color: #fff;
            box-shadow: 0 5px 15px rgba(0, 210, 255, 0.3);
        }

        /* Custom Input Dark */
        .form-floating > .form-control {
            background-color: #0f1116 !important;
            border: 1px solid #2c2e33 !important;
            color: #fff !important;
            border-radius: 12px;
        }

        .form-floating > .form-control:focus {
            border-color: var(--primary-accent) !important;
            box-shadow: 0 0 0 0.25rem rgba(0, 210, 255, 0.1);
        }

        .form-floating label {
            color: #6c7293;
        }

        /* Button Modern */
        .btn-signin {
            background: linear-gradient(to right, #00d2ff, #3a7bd5);
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 210, 255, 0.2);
            filter: brightness(1.1);
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
        }

        .register-link {
            color: var(--primary-accent);
            text-decoration: none;
            font-weight: 600;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="bg-decoration">
        <i class="fa fa-book-open"></i>
    </div>

    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">

                <div class="login-card p-4 p-sm-5 my-4 mx-3">
                    
                    <div class="brand-section">
                        <div class="brand-logo">
                            <i class="fa fa-book-reader"></i>
                        </div>
                        <h3 class="fw-bold text-white mb-1">Perpustakaan Digital</h3>
                        <p class="text-muted small">Gerbang Pengetahuan Digital</p>
                    </div>

                    {{-- NOTIFIKASI --}}
                    @if(session('success'))
                        <div class="alert alert-success text-success border-success mb-4">
                            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error') || $errors->any())
                        <div class="alert alert-danger text-danger border-danger mb-4">
                            <i class="fa fa-exclamation-triangle me-2"></i>
                            @if(session('error')) {{ session('error') }} @else Cek kembali data Anda @endif
                        </div>
                    @endif

                    <form action="{{ route('login.process') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input 
                                type="email"
                                name="email"
                                class="form-control"
                                id="emailInput"
                                placeholder="name@example.com"
                                required
                            >
                            <label for="emailInput"><i class="fa fa-envelope me-2"></i>Email Address</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input 
                                type="password"
                                name="password"
                                class="form-control"
                                id="passInput"
                                placeholder="Password"
                                required
                            >
                            <label for="passInput"><i class="fa fa-lock me-2"></i>Password</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-signin w-100 mb-4">
                            MASUK <i class="fa fa-sign-in-alt ms-2"></i>
                        </button>

                        <div class="text-center">
                            <span class="text-muted small">Belum memiliki akses?</span>
                            <a href="{{ route('register') }}" class="register-link ms-1 small">Daftar Akun</a>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('assetsbackend/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>