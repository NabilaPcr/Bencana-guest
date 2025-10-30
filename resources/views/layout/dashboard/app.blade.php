<!DOCTYPE html>
<html lang="id">

<head>
    {{-- START CSS  --}}
    @include('layout.dashboard.css')
    {{-- END CSS  --}}
</head>

<body>
    <!-- START Navbar -->
    @include('layout.dashboard.header')
    {{-- END NAVBAR  --}}

    <!-- Main Content-->
 @yield('content')
    {{-- END MAIN CONTENT  --}}

    <!-- Footer -->
    @include('layout.dashboard.footer')
    {{-- END FOOTER  --}}

        {{-- START JS  --}}
   @include('layout.dashboard.js')
    {{-- END JS  --}}
</body>

</html>
