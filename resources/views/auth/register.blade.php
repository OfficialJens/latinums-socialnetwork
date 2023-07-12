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
        <div class="row g-0 justify-content-center bg-body-dark">
            <div class="hero-static col-sm-10 col-md-8 col-xl-6 d-flex align-items-center p-2 px-sm-0">
                <div class="block block-rounded block-transparent block-fx-pop w-100 mb-0 overflow-hidden bg-image" style="background-image: url('https://i.imgur.com/dMyRzaA.jpg');">
                    <div class="row g-0">
                        <div class="col-md-6 order-md-1 bg-body-extra-light">
                            <div class="block-content block-content-full px-lg-5 py-md-5 py-lg-6">
                                <div class="mb-2 text-center">
                                    <a class="link-fx fw-bold fs-1" href="{{ url('login') }}">
                                        <span class="text-dark">{{ env('APP_NAME') }}</span>
                                    </a>
                                    <p class="text-uppercase fw-bold fs-sm text-muted">Account Aanmaken</p>
                                </div>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-alt @error('nickname') is-invalid @enderror" id="nickname" name="nickname" placeholder="Gebruikersnaam">
                                            @error('nickname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="mb-4">
                                        <input type="text" class="form-control form-control-alt @error('name') is-invalid @enderror" id="name" name="name" placeholder="Naam">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="mb-4">
                                        <input type="email" class="form-control form-control-alt @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="mb-4">
                                        <input type="password" class="form-control form-control-alt @error('password') is-invalid @enderror" id="password" name="password" placeholder="Wachtwoord">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>

                                    <div class="mb-4">
                                        <input type="password" class="form-control" id="password-confirm"  name="password_confirmation" placeholder="Herhaal Wachtwoord" required autocomplete="new-password">
                                    </div>

                                    <div class="mb-4">
                                        <button type="submit" class="btn w-100 btn-hero btn-primary">
                                            <i class="fa fa-fw fa-plus opacity-50 me-1"></i> Account Aanmaken
                                        </button>
                                    </div>

                                    <div class="mb-4">
                                        <button type="button" onclick="history.back()" class="btn w-100 btn-hero btn-alt-secondary">
                                            <i class="fa fa-fw fa-arrow-left opacity-50 me-1"></i> Ga Terug
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
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
