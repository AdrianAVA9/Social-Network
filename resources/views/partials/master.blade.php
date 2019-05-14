<nav class="navbar navbar-expand-lg navbar-dark app-secondary-bg">
  <a class="navbar-brand app-brand" href="{{ route( (Auth::guest()) ? 'home.index' : 'post.index') }}"><span>SOCIAL NETWORK</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
        @guest
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link app-color-tertiary" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link app-color-tertiary" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                </li>
            @endif
        </ul>
        @else
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a class="nav-link app-color-tertiary" href="{{ route('post.index') }}">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link app-color-tertiary" href="{{ route('album.index',['id' => Auth::user()->profiles->id, 'album_id' => -1]) }}">Album de fotos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link app-color-tertiary" href="{{ route('friend.search') }}">Buscar amigo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link app-color-tertiary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                    {{ __('Salir') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    @endguest
    @if(!Auth::guest())
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <ul class="form-inline" style="padding-left:0;">
                    <div class="app-rounded-image-1 mr-1">
                        <img src="{{ URL::to( Auth::user()->profiles->img_uri ) }}" alt="profile">
                    </div>
                    <a class="nav-link app-color-tertiary" href="{{ route('profile.myProfile') }}">{{ Auth::user()->name }}</a>
                </ul>
            </li>
        </ul>
    @endif
  </div>
</nav>