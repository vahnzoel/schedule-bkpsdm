<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>BKPSDM Kabupaten Tangerang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="BKPSDM Kabupaten Tangerang" name="description" />
    <meta content="Irfan Zul Fahmi" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <livewire:styles /> --}}
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/tangkab.png') }}">

    <link data-navigate-once href="{{ URL::asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ URL::asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ URL::asset('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ URL::asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.css') }}">
    <!-- Bootstrap Css -->
    <link data-navigate-once href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style"
        rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link data-navigate-once href="{{ URL::asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />
    @livewireStyles
</head>

<!-- <body data-layout="horizontal" data-topbar="dark" oncontextmenu="return false" onselectstart="return false"
      ondragstart="return false"> -->

<body data-layout="horizontal" data-topbar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('layouts.app-topbar')

        @include('layouts.app-topnav')

        {{ $slot }}

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        {{ date('Y') }} © BKPSDM Kabupaten Tangerang
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                            Developed with
                            <i class="mdi mdi-heart text-danger"></i> by
                            <b><a href="https://vahnzoel.github.io/" target="_blank">Vahn Zoel</a></b>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->
    <!-- JAVASCRIPT -->
    <script data-navigate-once src="{{ URL::asset('assets/libs/jquery/jquery.min.js') }}"></script>

    <!-- JAVASCRIPT -->
    <script data-navigate-once src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <!-- fullcalendar -->
    <script src="{{ URL::asset('assets/libs/fullcalendar/index.global.js') }}"></script>
    <!-- apexcharts -->
    <script data-navigate-once src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ URL::asset('assets/libs/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/chartjs.init.js') }}"></script>
    <!-- echarts js -->
    <script src="{{ URL::asset('assets/libs/echarts/echarts.min.js') }}"></script>
    <!-- echarts init -->
    <script src="{{ URL::asset('assets/js/pages/echarts.init.js') }}"></script>
    <!-- flot plugins -->
    <script src="{{ URL::asset('assets/libs/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flot-charts/jquery.flot.time.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/jquery.flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flot-charts/jquery.flot.selection.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flot-charts/jquery.flot.stack.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flot.curvedLines/curvedLines.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/flot-charts/jquery.flot.crosshair.js') }}"></script>

    <!-- flot init -->
    <script src="{{ URL::asset('assets/js/pages/flot.init.js') }}"></script>

    <script src="{{ URL::asset('assets/libs/jquery-knob/jquery.knob.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/jquery-knob.init.js') }}"></script>

    <script src="{{ URL::asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/sparklines.init.js') }}"></script>
    <!-- tui charts plugins -->
    <script src="{{ URL::asset('assets/libs/tui-chart/tui-chart-all.min.js') }}"></script>

    <!-- tui charts map -->
    <script src="{{ URL::asset('assets/libs/tui-chart/maps/usa.js') }}"></script>

    <!-- tui charts plugins -->
    <script src="{{ URL::asset('assets/js/pages/tui-charts.init.js') }}"></script>

    <script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ URL::asset('assets/js/app.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <script src="{{ URL::asset('assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}">
    </script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}">
    </script>
    <script data-navigate-once src="{{ URL::asset('assets/libs/@chenfengyuan/datepicker/datepicker.min.js') }}"></script>

    <!-- bs custom file input plugin -->
    <script src="{{ URL::asset('assets/libs/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <!-- form advanced init -->
    <script src="{{ URL::asset('assets/js/pages/form-advanced.init.js') }}"></script>

    <!-- fontawesome icons init -->
    <script src="{{ URL::asset('assets/js/pages/fontawesome.init.js') }}"></script>

    <!-- materialdesign icon js-->
    <script src="{{ URL::asset('assets/js/pages/materialdesign.init.js') }}"></script>

    <script src="{{ URL::asset('assets/js/app.js') }}"></script>

    <script data-navigate-once src="{{ URL::asset('vendor/livewire-alert/sweetalert2@11.js') }}"></script>
    <script data-navigate-once src="{{ URL::asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    @livewireScripts
</body>

</html>
