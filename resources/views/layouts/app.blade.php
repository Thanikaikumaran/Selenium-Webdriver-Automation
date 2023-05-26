<!DOCTYPE html>
<html lang="en">

<head>
    <title>IMS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('plugins/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/css/datatables/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/css/datatables/select.dataTables.min.css')}}">
    @stack('moreCss')
</head>

<body>
    <div class="container-scroller">
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-5"><img src="{{ asset('plugins/images/logo.png')}}" class="mr-2" alt="logo" /></a>
                <a class="navbar-brand brand-logo-mini"><img src="{{ asset('plugins/images/logo.png')}}" alt="logo" /></a>
            </div>
            @include('layouts.header')
        </nav>
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/js/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/js/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/js/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/js/datatables/dataTables.select.min.js') }}"></script>
    @stack('moreJs')
</body>

</html>