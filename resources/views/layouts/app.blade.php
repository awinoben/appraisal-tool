<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Java House Employee Appraisal') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <meta name="author" content="SHIFTECH AFRICA">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ config('app.name') }}"/>
    <meta property="og:image" content="{{ asset('img/favicon.png') }}"/>
    <meta property="og:description"
          content="Appraisal Tool"/>

    @livewireStyles
</head>
<body>

<div class="container-scroller">
    @if (!request()->routeIs('login'))
        <livewire:inc.top-nav/>
    @endif

    {{ $slot }}
</div>

@livewireScripts
<script src="{{ asset('js/sweet-alert.js') }}">
</script>
<x-livewire-alert::scripts/>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<script src="{{ asset('assets/js/todolist.js') }}"></script>
<!-- End custom js for this page -->
</body>
</html>
