<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no,
      minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/backend/css/img/favicon/favicon.ico') }}" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/backend/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/fonts/flag-icons.css') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/css/cropper.min.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>


    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/backend/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/backend/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/backend/libs/dropzone/dropzone.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/backend/libs/flatpickr/flatpickr.css') }}" />


    <script type="text/javascript">
        var BASE_URL = "{{ url('/') }}/";
        var ADMIN = "admin";
    </script>






    <script>
        var admin_url = '{{ URL::to('/admin') }}';
    </script>
    @yield('head')
</head>
{{-- .......................................content......................................................... --}}

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('Backend.Layouts.sidebar')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('Backend.Layouts.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('main_content')
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    @include('Backend.Layouts.footer')
                    <!-- / Footer -->
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- Overlay -->
    <!-- <div class="layout-overlay layout-menu-toggle"></div> -->
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <!-- <div class="drag-target"></div> -->
    </div>
    {{-- .................................Java Script......................................................... --}}
    <!-- Helpers -->
    <script src="{{ asset('assets/backend/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/backend/css/js/config.js') }}"></script>
    <script src="{{ asset('assets/backend/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/backend/js/bootstrap.js') }}"></script>

    <script src="{{ asset('assets/backend/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/backend/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Vendors JS -->
    <script src="{{ asset('assets/backend/libs/apex-charts/apexcharts.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/backend/css/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/backend/css/js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('assets/backend/js/cropper.min.js') }}"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>


    <script src="{{ asset('assets/backend/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/datatables-responsive/datatables.responsive.js') }}"></script>
    <script src="{{ asset('assets/backend/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>


    <script src="{{ asset('assets/backend/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/backend/css/js/extended-ui-sweetalert2.js') }}"></script>



    <script src="{{ asset('assets/backend/libs/dropzone/dropzone.js') }}"></script>

    <script src="{{ asset('assets/backend/libs/flatpickr/flatpickr.js') }}"></script>


    <script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>

    @yield('extraJs')
</body>

</html>
