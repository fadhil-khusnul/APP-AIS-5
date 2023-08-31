<!DOCTYPE html>
<html lang="{{Config::get('app.locale')}}" dir="ltr" data-theme="light">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">


    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('/') }}./assets/build/styles/ltr-core.css" rel="stylesheet">
    <link href="{{ asset('/') }}./assets/build/styles/ltr-vendor.css" rel="stylesheet">
    <link href="{{ asset('/') }}./assets/images/icon.png" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('/') }}./assets/build/scripts/jquery-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    
    
    
    <title>{{$title}} | AIS-ONLINE</title>
    @vite('resources/js/app.js')

</head>

<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
    <!-- BEGIN Preload -->
    <div class="preload">
        <div class="preload-dialog">
            <!-- BEGIN Spinner -->
            <div class="spinner-border text-primary preload-spinner"></div>
            <!-- END Spinner -->
        </div>
    </div>
    <!-- END Preload -->
    <!-- BEGIN Page Holder -->
    <div class="holder">
        <!-- BEGIN Aside -->
        @include('layouts.sidebar')
        <!-- END Aside -->
        <!-- BEGIN Page Wrapper -->
        <div class="wrapper" id="loading-wrapper">
            <!-- BEGIN Header -->
            @include('layouts.header')
            <!-- END Header -->
            <!-- BEGIN Page Content -->
            <div class="content">
                <div class="container-fluid g-5">
                    @yield('content')
                </div>
            </div>
            <!-- END Page Content -->
            <!-- BEGIN Footer -->
			@include('layouts.footer')
            <!-- END Footer -->
        </div>
        <!-- END Page Wrapper -->
    </div>
    <!-- END Page Holder -->
    <!-- BEGIN Float Button -->

    <!-- END Float Button -->
    <!-- BEGIN Offcanvas -->
    <!-- END Offcanvas -->

    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/mandatory.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/core.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/build/scripts/vendor.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/utilities/sticky-header.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/utilities/copyright-year.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/utilities/theme-switcher.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/utilities/tooltip-popover.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/utilities/dropdown-scrollbar.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/utilities/fullscreen-trigger.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/home.js"></script>


    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/datatable/extension/fixed-header.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/datatable/extension/search-panes.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/typeahead.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/datepicker.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/daterangepicker.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/select2.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/touchspin.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/inputmask.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/elements/sweet-alert.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/validation.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/datatable/extension/search-panes.js"></script> --}}



    <script type="text/javascript" src="{{ asset('/') }}./js/data.js"></script>




</body>

</html>
