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
        </div>
    </main>

@endsection
