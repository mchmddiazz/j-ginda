<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@stack('title')</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no , maximum-scale=1.0, user-scalable=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo/logoAlfitri.png')}}">

    <link href="{{ asset('alert/css/sweetalert2.css')}} " rel="stylesheet" />
    <!-- CSS
    ============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/sal.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/base.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">

    @stack('customcss')
</head>
