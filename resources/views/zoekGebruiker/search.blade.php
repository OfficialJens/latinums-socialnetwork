@extends('layouts.app')
@section('content')
    @include('layouts.header')

    <main id="main-container">
        <div class="content">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Gebruiker Opzoeken</h3>
                    <div class="block-options">
                        <div class="dropdown">
                            <a href="javascript:history.back()"><button type="button" class="btn-block-option" id="ga-terug">
                                    <i class="fa fa-arrow-left ms-1"></i> Ga Terug
                                </button></a>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <form action="{{ route('zoekGebruiker.search') }}" method="GET">
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Zoeken..">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if($persoonSearch->isNotEmpty())
                <div class="block block-rounded overflow-hidden">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Resultaten:</h3>
                    </div>
                    <div class="block-content tab-content overflow-hidden">
                        <div class="row">
                            @foreach($persoonSearch as $Gebruiker)
                                <div class="col-md-6 col-xl-3">
                                    <a class="block block-rounded block-link-pop text-center" href="{{ route('zoekGebruiker.profiel', $Gebruiker->id) }}">
                                        <div class="block-content block-content-full bg-image" style="background-image: url('https://i.imgur.com/dMyRzaA.jpg');">
                                            <img class="img-avatar img-avatar-thumb" src="{{ env('APP_URL') }}:8000/storage/{{ $Gebruiker->avatar }}" alt="Avatar">
                                        </div>
                                        <div class="block-content block-content-full">
                                            <p class="fw-semibold mb-0">{{ $Gebruiker->name }}</p>
                                            <p class="fs-sm fw-medium text-muted mb-0"><span>@</span>{{ $Gebruiker->nickname }}</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="row push">
                    <div class="col-xl-12 order-xl-0">
                        <div class="bg-body-dark fw-semibold rounded p-3 push text-center">
                            <i>Geen Resultaat..</i>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>

@endsection
