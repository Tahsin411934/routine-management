<!DOCTYPE html>
<html lang="en">

<head>
    @include('panel.includes.head')
</head>

<body class="sb-nav-fixed">

    @include('panel.includes.nav')

    <div id="layoutSidenav">

        @include('panel.includes.sidebar')

        <div id="layoutSidenav_content">

            @include('panel.includes.message')

            @yield('content')

            @include('panel.includes.footer')

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('panel/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('panel/js/datatables-simple-demo.js') }}"></script>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    @stack('js')

</body>

</html>
