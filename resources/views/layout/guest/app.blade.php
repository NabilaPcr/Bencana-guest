<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BinaDesa - Bersama Membantu Sesama</title>

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- start CSS -->
    @include('layout.guest.css')

    @yield('additional_css')
    {{-- end css  --}}
</head>
<body>
    <!-- Start Navbar -->
    @include('layout.guest.navbar')
    {{-- end navbar  --}}

    <!-- Main Content -->
    @yield('content')

    <!-- Include Footer -->
    @include('layout.guest.footer')

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- Include JS -->
    @include('layout.guest.js')

    @yield('additional_scripts')
</body>
</html>
