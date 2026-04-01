<!DOCTYPE html>
<html lang="en">

<head>

<title>Perpustakaan Digital</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assetsfrontend/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assetsfrontend/icomoon/icomoon.css') }}">
<link rel="stylesheet" href="{{ asset('assetsfrontend/css/vendor.css') }}">
<link rel="stylesheet" href="{{ asset('assetsfrontend/style.css') }}">

</head>

<body data-bs-spy="scroll" data-bs-target="#header">

{{-- NAVBAR --}}
@include('frontend.layout.navbar')

{{-- CONTENT --}}
@yield('content')

{{-- FOOTER --}}
@include('frontend.layout.footer')

<script src="{{ asset('assetsfrontend/js/jquery-1.11.0.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('assetsfrontend/js/plugins.js') }}"></script>
<script src="{{ asset('assetsfrontend/js/script.js') }}"></script>

</body>
</html>