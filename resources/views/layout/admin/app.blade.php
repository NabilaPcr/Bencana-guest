<!DOCTYPE html>
<html lang="id">
<head>

     {{-- start css  --}}
    @include('layout.admin.css')
    {{-- end css  --}}
</head>
<body>
    <!-- START NAVBAR -->
   @include('layout.admin.header')
    {{-- END NAVBAR --}}

    <!-- START MAIN CONTENT -->
   @yield('content')
    {{-- END MAIN CONTENT --}}

    <!-- FOOTER -->
    @include('layout.admin.footer')
    {{-- END FOOTER  --}}
</body>
</html>
