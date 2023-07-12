@extends('layouts.app')
@section('content')
    @include('layouts.header')

    <main id="main-container">
        @foreach($user as $gebruiker)
            <div class="content content-full content-boxed">
                <div class="rounded border overflow-hidden push">
                    <div class="bg-image pt-9" style="background-image: url('https://i.imgur.com/dMyRzaA.jpg');"></div>
                    <div class="px-4 py-3 bg-body-extra-light d-flex flex-column flex-md-row align-items-center">
                        <a class="d-block img-link mt-n5" href="javascript:void(0)">
                            <img class="img-avatar img-avatar128 img-avatar-thumb" src="{{ env('APP_URL') }}:8000/storage/{{ $gebruiker->avatar }}" alt="Avatar">
                        </a>
                        <div class="ms-3 flex-grow-1 text-center text-md-start my-3 my-md-0">
                            <h1 class="fs-4 fw-bold mb-1">{{ $gebruiker->name }}</h1>
                            <h2 class="fs-sm fw-medium text-muted mb-0">
                                <a href="javascript:void(0)" class="text-muted"><span>@</span>{{ $gebruiker->nickname }}</a> &bull; <a href="javascript:void(0)" class="text-muted">{{ $gebruiker->followers()->count() }} Volger(s)</a> &bull;  <a href="javascript:void(0)" class="text-muted">{{ $gebruiker->followings()->count() }} Volgend</a>
                            </h2>
                        </div>
                        <div class="space-x-1">
                            @if($gebruiker->id === Auth::user()->id)
                                <a href="javascript:void(0)" class="btn btn-sm btn-alt-secondary me-1">
                                    <i class="fa fa-user-plus opacity-50"></i>
                                    <span>Je kan jezelf niet volgen</span>
                                </a>
                            @else
                                @if(auth()->user()->isFollowing($gebruiker))
                                    <form action="{{ route('gebruiker.unFollow', $gebruiker->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-alt-danger space-x-1">
                                            <i class="fa fa-user-times opacity-50 me-1"></i> Niet meer volgen
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('gebruiker.follow', $gebruiker->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-alt-success space-x-1">
                                            <i class="fa fa-user-plus opacity-50 me-1"></i> Volgen
                                        </button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">

                        @foreach($user_posts as $user_P)
                            @if($gebruiker->id == $user_P->author)
                                <a class="block block-rounded block-link-shadow mb-3" href="{{ url('posts', ['id' => $user_P->id]) }}">
                                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                                        <h4 class="fs-base text-primary mb-0">
                                            <i class="fa fa-newspaper text-muted me-1"></i> {{ substr($user_P->body, 0, 30,) }}...
                                        </h4>
                                        <p class="fs-sm text-muted mb-0 ms-2 text-end">{{ date('H:s, d-m-Y', strtotime($user_P->created_at)) }}</p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </main>

@endsection
