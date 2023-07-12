@extends('layouts.app')
@section('content')
    @include('layouts.header')

    <main id="main-container">
        <div class="content content-full content-boxed">
            <div class="rounded border overflow-hidden push">
                <div class="bg-image pt-9" style="background-image: url('https://i.imgur.com/dMyRzaA.jpg');"></div>
                <div class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
                    <a class="d-block img-link mt-n5" href="javascript:void(0)">
                        <img class="img-avatar img-avatar128 img-avatar-thumb" src="{{ env('APP_URL') }}:8000/storage/{{ Auth::user()->avatar }}" alt="Avatar">
                    </a>
                    <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">
                        <h1 class="fs-4 fw-bold mb-1">{{ Auth::user()->name }}</h1>
                        <h2 class="fs-sm fw-medium text-muted mb-0"><span>@</span>{{ Auth::user()->nickname }}</h2>
                    </div>
                    <div class="space-x-1">
                        <a href="javascript:history.back()" class="btn btn-sm btn-alt-secondary space-x-1">
                            <i class="fa fa-arrow-left opacity-50"></i>
                            <span>Ga Terug</span>
                        </a>
                    </div>
                </div>
            </div>

            @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <p class="mb-0">{{ Session::get('success') }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <p class="mb-0"><b>Whoeps!</b> Er waren enkele problemen opgetreden..</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="block block-bordered block-rounded">
                <ul class="nav nav-tabs nav-tabs-alt" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link space-x-1 active" id="account-profile-tab" data-bs-toggle="tab" data-bs-target="#account-profile" role="tab" aria-controls="account-profile" aria-selected="true">
                            <i class="fa fa-user-circle d-sm-none"></i>
                            <span class="d-none d-sm-inline">Profiel Instellingen</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link space-x-1" id="account-avatar-tab" data-bs-toggle="tab" data-bs-target="#account-avatar" role="tab" aria-controls="account-avatar" aria-selected="false">
                            <i class="fa fa-asterisk d-sm-none"></i>
                            <span class="d-none d-sm-inline">Profiel Afbeelding</span>
                        </button>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="account-profile" role="tabpanel" aria-labelledby="account-profile-tab" tabindex="0">
                        <div class="row push p-sm-2 p-lg-4">
                            <div class="offset-xl-1 col-xl-4 order-xl-1">
                                <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                                    De vitale informatie van uw account.
                                </p>
                            </div>
                            <div class="col-xl-6 order-xl-0">
                                <form action="{{ route('instellingen.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="form-label" for="inputNickname">Nickname</label>
                                        <input type="text" class="form-control @error('nickname') is-invalid @enderror" id="nickname" name="nickname" placeholder="{{ Auth::user()->nickname }}">
                                        @error('nickname') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="inputName">Naam</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ Auth::user()->name }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="inputEmail">Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ Auth::user()->email }}">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="inputPassword">Nieuw Wachtwoord</label>
                                        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password">
                                        @if ($errors->has('password')) <span class="text-danger">{{ $errors->first('password') }}</span> @endif
                                    </div>

                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="fa fa-check-circle opacity-50 me-1"></i> Opslaan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="account-avatar" role="tabpanel" aria-labelledby="account-avatar-tab" tabindex="0">
                        <div class="row push p-sm-2 p-lg-4">
                            <div class="offset-xl-1 col-xl-4 order-xl-1">
                                <p class="bg-body-light p-4 rounded-3 text-muted fs-sm">
                                    Hier kan je avatar aanpassen.
                                </p>
                            </div>
                            <div class="col-xl-6 order-xl-0">
                                <form action="{{ route('avatar.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label class="form-label">Huidige Avatar</label>
                                        <div class="push">
                                            <img class="img-avatar" src="{{ env('APP_URL') }}:8000/storage/{{ Auth::user()->avatar }}" alt="Avatar">
                                        </div>
                                        <label class="form-label" for="dm-profile-edit-avatar">Kies een nieuwe avatar</label>
                                        <input class="form-control" name="avatar" type="file" id="avatar" accept="image/png, image/jpg, image/jpeg, image/svg">
                                    </div>
                                    <button type="submit" class="btn btn-alt-primary">
                                        <i class="fa fa-check-circle opacity-50 me-1"></i> Opslaan
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
