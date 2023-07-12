@extends('layouts.app')
@section('content')
    @include('layouts.header')

    <main id="main-container">
        <div class="content">
            <div class="row">
                <div class="col-md-16">
                    <div class="block block-rounded block-bordered">
                        <div class="block-header block-header-default">
                            <div>
                                <a class="img-link me-1" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar32 img-avatar-thumb" src="{{ env('APP_URL') }}:8000/storage/{{ $post->postAuthor->avatar }}" alt="Avatar">
                                </a>
                                <a class="fw-semibold" href="{{ route('zoekGebruiker.profiel', $post->postAuthor->id) }}">{{ $post->postAuthor->nickname }}</a>
                                <span class="fs-sm text-muted">{{ date('H:s, d-m-Y', strtotime($post->created_at)) }}</span>
                            </div>
                            @if ($post->author === Auth::user()->id)
                                <div class="block-options">
                                    <div class="dropdown">
                                        <button type="button" class="btn-block-option dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="far fa-fw fa-times-circle text-danger me-1"></i> Verwijder mijn post
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-exclamation-triangle me-1"></i> Rapporteer deze post.
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="block-content">
                            <p>{{ $post->body }}</p>
                            <hr>
                            <ul class="nav nav-pills fs-sm push">
                                <li class="nav-item me-1">
                                    @if(auth()->user()->hasLiked($post))
                                        <form action="{{ route('unlike.post', $post->id) }}" method="POST">
                                            @csrf
                                            <button class="nav-link" type="submit">
                                                <i class="fa fa-thumbs-up opacity-50 me-1"></i> Vind ik niet meer leuk
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('like.post', $post->id) }}" method="POST">
                                            @csrf
                                            <button class="nav-link" type="submit">
                                                <i class="fa fa-thumbs-up opacity-50 me-1"></i> Vind ik leuk
                                            </button>
                                        </form>
                                    @endif
                                </li>
                                <li class="nav-item me-1">
                                    <a class="nav-link" href="javascript:void(0)">
                                        <i class="fa fa-comment-alt opacity-50 me-1"></i> Reageren
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0)">
                                        <i class="fa fa-share-alt opacity-50 me-1"></i> Delen
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="block-content block-content-full bg-body-light">
                            <p class="fs-sm">
                                @if($post->likers()->count() == 0)
                                    <a class="fw-semibold" href="javascript:void(0)">Nog niemand heeft je post geliked!</a>
                                @elseif ($post->likers()->count() == 1)
                                    <i class="fa fa-heart text-danger"></i>
                                    <a class="fw-semibold" href="javascript:void(0)">{{ $post->likers()->count() }} persoon vind je post leuk!</a>
                                @else
                                    <i class="fa fa-heart text-danger"></i>
                                    <a class="fw-semibold" href="javascript:void(0)">{{ $post->likers()->count() }} personen vinden je post leuk!</a>
                                @endif
                            </p>
                            <form action="{{ route('comments.store') }}" method="POST">
                                @csrf
                                <input type="text" class="form-control form-control-alt" id="body" name="body" placeholder="Plaats een reactie..">
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </form>
                            <div class="pt-3 fs-sm">
                                @foreach($comments as $comment)
                                    @if ($post->id === $comment->post_id)
                                        <div class="d-flex">
                                            <a class="flex-shrink-0 img-link me-2" href="javascript:void(0)">
                                                <img class="img-avatar img-avatar32 img-avatar-thumb" src="{{ env('APP_URL') }}:8000/storage/{{ $comment->commentAuthor->avatar }}" alt="Avatar">
                                            </a>
                                            <div class="flex-grow-1">
                                                <p class="mb-1">
                                                    <a class="fw-semibold" href="{{ route('zoekGebruiker.profiel', $comment->commentAuthor->id) }}">{{ $comment->commentAuthor->nickname }}</a>
                                                    {{ $comment->body }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
