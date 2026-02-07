<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>BKPSDM Kabupaten Tangerang | LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BKPSDM Kabupaten Tangerang" name="description" />
    <meta content="Irfan Zul Fahmi" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link data-navigate-once rel="shortcut icon" href="{{ URL::asset('assets/images/tangkab.png') }}">

    <!-- Bootstrap Css -->
    <link data-navigate-once href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style"
        rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link data-navigate-once href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link data-navigate-once href="{{ URL::asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />
    <link data-navigate-once rel="stylesheet" type="text/css"
        href="{{ URL::asset('assets/libs/toastr/build/toastr.min.css') }}">
    @livewireStyles
</head>

<!-- <body oncontextmenu="return false" onselectstart="return false" ondragstart="return false"> -->

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            {{ $slot }}
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script data-navigate-once src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <!-- toastr plugin -->
    <script data-navigate-once src="{{ URL::asset('assets/libs/toastr/build/toastr.min.js') }}"></script>

    <!-- App js -->
    <script data-navigate-once src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('vendor/livewire-alert/sweetalert2@11.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('vendor/livewire/livewire.js') }}"></script>
    {{-- <x-livewire-alert::scripts />
    <x-livewire-alert::flash />
    @livewireScripts --}}
</body>

</html>
