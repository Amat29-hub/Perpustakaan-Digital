<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register Perpustakaan | Digital Library</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assetsbackend/css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        :root {
            --bg-dark-deep: #0f1116; /* Hitam pekat agar senada dengan Login */
            --bg-card: #191c24;      /* Warna card template */
            --primary-accent: #00d2ff; /* Warna aksen modern */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark-deep);
            color: #e4e6eb;
            overflow-x: hidden;
        }

        /* Dekorasi Background Besar - SAMA DENGAN LOGIN */
        .bg-decoration {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 35rem; /* Ukuran ikon super besar */
            color: rgba(255, 255, 255, 0.02); /* Sangat transparan */
            z-index: -1;
        }

        .login-card {
            background-color: var(--bg-card) !important;
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .brand-logo {
            background: linear-gradient(135deg, var(--primary-accent), #3a7bd5);
            width: 55px;
            height: 55px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            margin-bottom: 10px;
            font-size: 24px;
            color: #fff;
            box-shadow: 0 5px 15px rgba(0, 210, 255, 0.3);
        }

        /* Form Styling */
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

        .btn-register {
            background: linear-gradient(to right, #00d2ff, #3a7bd5);
            border: none;
            border-radius: 12px;
            font-weight: 700;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 210, 255, 0.2);
            filter: brightness(1.1);
        }

        /* Alert Error Styling */
        .alert-danger {
            border-radius: 12px;
            background-color: rgba(220, 53, 69, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.2);
            color: #f8d7da;
            font-size: 0.85rem;
        }

        .login-link {
            color: var(--primary-accent);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        /* Spinner custom color */
        #spinner {
            background-color: var(--bg-dark-deep) !important;
        }
        #spinner .spinner-border {
            color: var(--primary-accent) !important;
        }
    </style>
</head>

<body>

<div class="container-fluid position-relative d-flex p-0">
    
    <div class="bg-decoration">
        <i class="fa fa-user-plus"></i>
    </div>

    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>

    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">

                <div class="login-card p-4 p-sm-5 my-4 mx-3">

                    <div class="text-center mb-4">
                        <div class="brand-logo">
                            <i class="fa fa-book"></i>
                        </div>
                        <h3 class="fw-bold text-white mb-1">Bergabung</h3>
                        <p class="text-muted small">Buat akun untuk mulai meminjam buku</p>
                    </div>

                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required value="{{ old('name') }}">
                            <label><i class="fa fa-user me-2"></i>Nama Lengkap</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required value="{{ old('email') }}">
                            <label><i class="fa fa-envelope me-2"></i>Email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                            <label><i class="fa fa-lock me-2"></i>Password</label>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                            <label><i class="fa fa-shield-alt me-2"></i>Konfirmasi Password</label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-register w-100 mb-4">
                            DAFTAR SEKARANG <i class="fa fa-arrow-right ms-2"></i>
                        </button>

                        <div class="text-center">
                            <span class="text-muted small">Sudah memiliki akun?</span>
                            <a href="{{ route('login') }}" class="login-link ms-1 small">Login</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assetsbackend/js/main.js') }}"></script>

</body>
</html>