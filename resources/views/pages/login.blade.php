<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;1,300;1,400;1,500&display=swap" rel="stylesheet">

<link href="{{ asset('/') }}./assets/build/styles/ltr-core.css" rel="stylesheet">
<link href="{{ asset('/') }}./assets/build/styles/ltr-vendor.css" rel="stylesheet">
<link href="{{ asset('/') }}./assets/images/icon.png" rel="shortcut icon" type="image/x-icon">
<link href="{{ asset('/') }}./assets/build/scripts/jquery-ui.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('/') }}./assets/build/styles/normalize.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}./assets/build/styles/login.css">
    <link href="{{ asset('/') }}./assets/images/icon.png" rel="shortcut icon" type="image/x-icon">



    <title>{{ $title }} AIS-ONLINE</title>
</head>

<body class="body-login" id="loading">
    @include('sweetalert::alert')

    <div class="container-login"></div>
    @yield('login')




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

    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/elements/sweet-alert.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/validation.js"></script>
    <script type="text/javascript" src="{{ asset('/') }}./assets/app/pages/form/inputmask.js"></script>


    


    <script type="text/javascript" src="{{ asset('/') }}./js/login.js"></script>


</body>

</html>
