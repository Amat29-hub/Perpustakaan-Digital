<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Perpustakaan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Library -->
    <link href="{{ asset('assetsbackend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assetsbackend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{{ asset('assetsbackend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template CSS -->
    <link href="{{ asset('assetsbackend/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Spinner -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
        </div>

        <!-- Sidebar -->
        @include('backend.layout.sidebar')

        <!-- Content Start -->
        <div class="content">

            <!-- Navbar -->
            @include('backend.layout.navbar')

            <!-- Main Content -->
            @yield('content')

            <!-- Footer -->
            @include('backend.layout.footer')

        </div>
        <!-- Content End -->

    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assetsbackend/lib/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assetsbackend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assetsbackend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assetsbackend/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assetsbackend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('assetsbackend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assetsbackend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assetsbackend/js/main.js') }}"></script>
</body>
</html>