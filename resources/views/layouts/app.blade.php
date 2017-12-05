<!DOCTYPE html>
<html dir="ltr" lang="{{ app()->getLocale() }}">
<head>

    <!-- Your Stylesheets, Scripts & Title
    ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/canvas/css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="/canvas/style.css" type="text/css" />
    <link rel="stylesheet" href="/canvas/css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="/canvas/css/dark.css" type="text/css" />
    <link rel="stylesheet" href="/canvas/css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="/canvas/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="/canvas/css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="/canvas/css/responsive.css" type="text/css" />

</head>
<body class="stretched">

<!-- The Main Wrapper
============================================= -->
<div id="wrapper" class="clearfix">

    <!-- Header
    ============================================= -->
    <header id="header" class="sticky-style-2">

        <div class="container clearfix">

            <!-- Logo
            ============================================= -->
            <div id="logo" class="divcenter">
                <a href="/" class="standard-logo" data-dark-logo="images/logo-dark.png"><img class="divcenter" src="/canvas/images/logo.png" alt="Canvas Logo"></a>
                <a href="/" class="retina-logo" data-dark-logo="images/logo-dark@2x.png"><img class="divcenter" src="/canvas/images/logo@2x.png" alt="Canvas Logo"></a>
            </div><!-- #logo end -->

        </div>

        <div id="header-wrap">

                <!-- Primary Navigation
                ============================================= -->
                @include('layouts.nav')

        </div>

    </header><!-- #header end -->

    <!-- Site Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                @yield('content')

                <flash message="{{ session('flash') }}"></flash>
            </div>

        </div>

    </section>


</div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="/canvas/js/jquery.js"></script>
<script type="text/javascript" src="/canvas/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="/canvas/js/functions.js"></script>
</body>
</html>