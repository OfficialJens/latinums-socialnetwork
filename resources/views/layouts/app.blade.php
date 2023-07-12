<!doctype html>
<html lang="nl_NL">
<head>
    <!--Open Graph Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>{{ env('APP_NAME') }} - Social Network</title>

    <meta name="description" content="Eindwerk Social Network">
    <meta name="author" content="OfficialJens#0001">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:title" content="{{ env('APP_NAME') }} - Social Network">
    <meta property="og:site_name" content="OfficialJens#0001">
    <meta property="og:description" content="Eindwerk Social Network">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">

    <!-- Stylesheets -->
    <link rel="stylesheet" id="css-main" href="{{ asset('css/dashmix.min.css') }}">
    <link rel="stylesheet" id="css-theme" href="{{ asset('css/themes/xmodern.min.css') }}">

</head>
<body>
    <div id="page-container" class="sidebar-dark enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-boxed">
        @yield('content')
        @include('layouts.footer')
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/dashmix.app.min.js') }}"></script>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

</body>
</html>
