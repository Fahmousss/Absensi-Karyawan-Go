<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ Session::token() }}">

    <title>@yield('title') - Sistem Manajemen Absensi CVGO </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/owl-carousel/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/vendor/owl-carousel/css/owl.theme.default.min.css') }}">
    <link href="{{ asset('/vendor/jqvmap/css/jqvmap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <!-- Datetable -->
    <link href="{{ asset('/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    {{-- Daterange Picker --}}
    <link href="{{ asset('/vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
   
    @yield('extra-css')

</head>

@guest

    <body class="hold-transition login-page h-100">
        @yield('content')
    @else
        @if (Route::currentRouteName() == 'password.request' ||
                Route::currentRouteName() == 'password.reset' ||
                Route::currentRouteName() == 'password.confirm')

            <body class="hold-transition login-page h-100">
                @yield('content')
            @else

                <body>

                    <!--*******************
                            Preloader start
                        ********************-->
                    <div id="preloader">
                        <div class="sk-three-bounce">
                            <div class="sk-child sk-bounce1"></div>
                            <div class="sk-child sk-bounce2"></div>
                            <div class="sk-child sk-bounce3"></div>
                        </div>
                    </div>
                    <!--*******************
                            Preloader end
                        ********************-->


                    <!--**********************************
                            Main wrapper start
                        ***********************************-->
                    <div id="main-wrapper">

                        <!--**********************************
                                Nav header start
                            ***********************************-->
                        <div class="nav-header">
                            <a href="javascript:void(0)" class="brand-logo">
                                <img class="brand-title" src="{{ asset('/images/logo-grey.png') }}" alt="">
                            </a>

                            <div class="nav-control">
                                <div class="hamburger">
                                    <span class="line"></span><span class="line"></span><span class="line"></span>
                                </div>
                            </div>
                        </div>
                        @include('includes.navbar')
                        <!--**********************************
                                Nav header end
                            ***********************************-->


                        <!--**********************************
                                Sidebar start
                            ***********************************-->
                        @include('includes.main_sidebar')
                        <!--**********************************
                                Sidebar end
                            ***********************************-->

                        <!--**********************************
                                Content body start
                            ***********************************-->
                        <div class="content-body">
                            <!-- row -->
                            <div class="container-fluid">
                                @yield('content')
                            </div>
                        </div>
                        <!--**********************************
                                Content body end
                            ***********************************-->


                        <!--**********************************
                                Footer start
                            ***********************************-->
                        <div class="footer">
                            <div class="copyright">
                                <p>Copyright © Designed &amp; Developed by *</p>
                            </div>
                        </div>
                        <!--**********************************
                                Footer end
                            ***********************************-->

                        <!--**********************************
                               Support ticket button start
                            ***********************************-->

                        <!--**********************************
                               Support ticket button end
                            ***********************************-->
                    </div>
        @endif
    @endguest
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('/js/custom.min.js') }}"></script>


    <!-- Vectormap -->
    <script src="{{ asset('/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('/vendor/morris/morris.min.js') }}"></script>


    <script src="{{ asset('/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('/vendor/chart.js/Chart.bundle.min.js') }}"></script>

    <script src="{{ asset('/vendor/gaugeJS/dist/gauge.min.js') }}"></script>

    <!--  flot-chart js -->
    <script src="{{ asset('/vendor/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('/vendor/flot/jquery.flot.resize.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('/vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{ asset('/vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('/vendor/jqvmap/js/jquery.vmap.usa.js') }}"></script>
    <script src="{{ asset('/vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{ asset('/js/dashboard/dashboard-1.js') }}"></script>
    <!-- Daterange Picker -->
    <script src="{{ asset('/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('/js/plugins-init/bs-daterange-picker-init.js') }}"></script>

    {{-- Data Table --}}
    <script src="{{ asset('/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/plugins-init/datatables.init.js') }}"></script>

   
   
    @yield('extra-js')
</body>

</html>
