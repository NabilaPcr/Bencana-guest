<!DOCTYPE html>
<html lang="id">
<head>

    {{-- START CSS  --}}
    @include('layout.guest.css')
    {{-- END CSS  --}}
</head>
<body>
    <!-- NAVBAR -->
   @include('layout.guest.navbar')
     {{-- END NAVBAR  --}}

    <!-- MAIN CONTENT -->
    @yield('content')
    {{-- END MAIN CLASS  --}}

    <!-- START FOOTER -->
    @include('layout.guest.footer')
    {{-- END FOOTER  --}}

    <!-- START JS -->
  @include('layout.guest.js')
    {{-- END JS  --}}

</body>
</html>
