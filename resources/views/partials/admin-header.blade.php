<nav class="navbar navbar-expand-lg app-secondary-bg">
  <a class="navbar-brand app-brand" href="{{ route('home.index') }}">SOCIAL <span>NETWORK</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse navbar-right" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link app-color-tertiary" href="{{ route('home.index') }}">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link app-color-tertiary" href="{{ route('album.index',['id' => 1, 'album_id' => -1]) }}">Album de fotos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link app-color-tertiary" href="{{ route('friend.search') }}">Buscar amigo</a>
      </li>
      <li class="nav-item ml-5">
        <div class="app-rounded-image">
            <img src="{{ URL::to('assets/images/user/profile.jpg') }}" alt="profile">
        </div>
      </li>
      <li class="nav-item mr-5">
        <a class="nav-link app-color-tertiary" href="{{ route('profile.myProfile') }}">Username</a>
      </li>
    </ul>
  </div>
</nav>