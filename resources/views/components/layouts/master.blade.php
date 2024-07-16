<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
           <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

        <!-- sweatalert2 llibrary -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.2/sweetalert2.min.css" integrity="sha512-WxRv0maH8aN6vNOcgNFlimjOhKp+CUqqNougXbz0E+D24gP5i+7W/gcc5tenxVmr28rH85XHF5eXehpV2TQhRg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
        />
        <!-- style css -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

        <!-- Icons. Uncomment required icon fonts -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- datatables CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dataTables/datatables.bootstrap5.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dataTables/responsive.bootstrap5.css') }}" />

        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
        <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

        <!-- Vendors CSS -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

        <!-- Page CSS -->

        <!-- Helpers -->
        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        <script src="{{ asset('assets/js/config.js') }}"></script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

        @stack('styles')



    </head>
    <body>
            <!-- Layout wrapper -->
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- sidebar -->

                <x-layouts.layout_partials.sidebar  />

                <!-- / sidebar -->

                <!-- Layout container -->
                <div class="layout-page">

                    <!-- navbar -->

                    <x-layouts.layout_partials.navbar  />

                    <!-- / navbar -->
                <!-- content start -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        {{ $slot }}
                    </div>
                </div>
                <!-- content end -->

                <!-- footer start -->
                <x-layouts.layout_partials.footer  />
                <!-- footer end -->

                </div>
                <!-- Navbar -->

            </div>
              <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- all elment end -->

        <!-- Core JS -->
        <!-- datatabs JS -->
        <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

         <!-- build:js assets/vendor/js/core.js -->
         <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
         <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
         <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
         <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

         <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
         <!-- endbuild -->

         <!-- Vendors JS -->
         <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

        <!-- dataTable JS -->
        <script src="{{ asset('assets/vendor/libs/dataTables/dataTable.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/dataTables/dataTables-bootstrap5.js') }}"></script>


         <!-- Main JS -->
         <script src="{{ asset('assets/js/main.js') }}"></script>

         <!-- Page JS -->
         <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

         <!-- libreries JS -->


         <!-- cdn sweat alert2 JS -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.12.2/sweetalert2.min.js" integrity="sha512-JWPRTDebuCWNZTZP+EGSgPnO1zH4iie+/gEhIsuotQ2PCNxNiMfNLl97zPNjDVuLi9UWOj82DEtZFJnuOdiwZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

         <!-- Place this tag in your head or just before your close body tag. -->
         <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        @stack('scripts')
    </body>

</html>
