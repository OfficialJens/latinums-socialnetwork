<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <a class="btn btn-alt-secondary me-2" href="{{ url('home') }}">
                <i class="fa fa-campground"></i>
            </a>
            <a class="btn btn-alt-secondary me-2" href="{{ url('gebruiker-zoeken') }}">
                <i class="fa fa-search"></i>
            </a>
        </div>

        <div>
            <a class="btn btn-alt-secondary d-none d-sm-inline-block"  href="{{ url('gebruiker', ['id' => Auth::user()->id]) }}">
                <i class="fa fa-user-circle opacity-50 me-1"></i> {{ Auth::user()->nickname }}
            </a>
        </div>
    </div>

    <div id="page-header-loader" class="overlay-header bg-primary-darker">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
            </div>
        </div>
    </div>
</header>
