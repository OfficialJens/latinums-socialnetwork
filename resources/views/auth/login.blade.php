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
</head>

<body>
<div id="page-container">
    <main id="main-container">
        <div class="bg-image" style="background-image: url('https://i.imgur.com/dMyRzaA.jpg');">
            <div class="row g-0 bg-primary-op">
                <div class="hero-static col-md-6 d-flex align-items-center bg-body-extra-light">
                    <div class="p-3 w-100">
                        <div class="mb-3 text-center">
                            <a class="link-fx fw-bold fs-1" href="{{ url('login') }}">
                                <span class="text-dark">{{ env('APP_NAME') }}</span>
                            </a>
                            <p class="text-uppercase fw-bold fs-sm text-muted">Aanmelden</p>
                        </div>
                        <div class="row g-0 justify-content-center">
                            <div class="col-sm-8 col-xl-6">

                                @error('email')
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <div class="flex-shrink-0">
                                        <i class="fa fa-fw fa-warning"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{ $message }}</p>
                                    </div>
                                </div>
                                @enderror

                                @error('password')
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <div class="flex-shrink-0">
                                        <i class="fa fa-fw fa-warning"></i>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <p class="mb-0">{{ $message }}</p>
                                    </div>
                                </div>
                                @enderror

                                <form class="js-validation-signin" action="{{ url('/login') }}" method="POST">
                                    @csrf
                                    <div class="py-3">
                                        <div class="mb-4">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="voorbeeld@gmail.com" required>
                                        </div>
                                        <div class="mb-4">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Wachtwoord" required>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <button type="submit" class="btn w-100 btn-lg btn-hero btn-primary">
                                            <i class="fa fa-fw fa-sign-in-alt opacity-50 me-1"></i> LogIn
                                        </button>
                                        <p class="mt-3 mb-0 d-lg-flex justify-content-lg-between">
                                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="javascript:void(0)">
                                                <i class="fa fa-exclamation-triangle opacity-50 me-1"></i> Nog geen account?
                                            </a>
                                            <a class="btn btn-sm btn-alt-secondary d-block d-lg-inline-block mb-1" href="{{ url('register') }}">
                                                <i class="fa fa-plus opacity-50 me-1"></i> Account Aanmaken!
                                            </a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-static col-md-6 d-none d-md-flex align-items-md-center justify-content-md-center text-md-center">
                    <div class="p-3">
                        <p class="display-4 fw-bold text-white mb-3">
                            Welkom op {{ env('APP_NAME') }}!
                        </p>
                        <p class="fs-lg fw-semibold text-white-75 mb-0">
                            Maak een GRATIS account aan! - &copy; <span data-toggle="year-copy"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script src="{{ asset('js/dashmix.app.min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
</body>
</html>
