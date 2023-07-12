@extends('layouts.app')
@section('content')
    @include('layouts.header')

    <main id="main-container">
        <div class="content content-full">
            <div class="row">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="block block-bordered block-rounded bg-body">
                        <div class="block-content">
                            <div class="bg-body rounded p-2 mb-3 d-flex align-items-center">
                                <a class="img-link d-inline-block" href="javascript:void(0)">
                                    <img class="img-avatar img-avatar48" src="{{ env('APP_URL') }}:8000/storage/{{ Auth::user()->avatar }}" alt="Avatar">
                                </a>
                                <div class="ms-3">
                                    <a class="fw-semibold" href="javascript:void(0)">{{ Auth::user()->name }}</a>
                                    <div class="fs-sm text-muted"><span>@</span>{{ Auth::user()->nickname }}</div>
                                </div>
                            </div>
                            <ul class="nav-main">
                                <li class="nav-main-heading">Algemeen</li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{ url('instellingen') }}">
                                        <i class="nav-main-link-icon fa fa-gear"></i>
                                        <span class="nav-main-link-name">Instellingen</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{ url('gebruiker', ['id' => Auth::user()->id]) }}">
                                        <i class="nav-main-link-icon far fa-user-circle"></i>
                                        <span class="nav-main-link-name">Mijn Profiel</span>
                                    </a>
                                </li>
                                <li class="nav-main-heading">Afmelden</li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link" href="{{ url('afmelden') }}">
                                        <i class="nav-main-link-icon fa fa-arrow-left"></i>
                                        <span class="nav-main-link-name">Afmelden</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9">

                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <p class="mb-0">{{ Session::get('success') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="block block-bordered block-rounded">
                        <div class="block-content block-content-full">
                            <form action="{{ route('posts.store') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="body" id="body" class="form-control form-control-alt" placeholder="Hoe was je dag vandaag?" required>
                                    <input type="hidden" name="author" id="author" value="{{ Auth::user()->id }}">
                                    <button type="submit" class="btn btn-primary border-0">
                                        <i class="fa fa-pencil-alt opacity-50 me-1"></i> Plaats
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @foreach($posts as $post)
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
                                                <a class="dropdown-item" href="{{ route('posts.delete', $post->id) }}">
                                                    <i class="far fa-fw fa-times-circle text-danger me-1"></i> Verwijder mijn post
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
                                                    <i class="fa fa-thumbs-up text-info opacity-50 me-1"></i> Vind ik niet meer leuk
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
                                        <a class="nav-link" href="{{ url('posts', ['id' => $post->id]) }}">
                                            <i class="fa fa-comment-alt opacity-50 me-1"></i> Reageren
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('posts', ['id' => $post->id]) }}">
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
                                                    @if($comment->user_id == Auth::user()->id)
                                                        <p>
                                                            <a href="{{ route('comment.delete', $comment->id) }}">Verwijder comment</a>
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

@endsection
