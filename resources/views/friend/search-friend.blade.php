@extends('layouts.master')

@section('content')
    <label for="">Buscar amigo</label>
    <form class="form-inline" method="get" action="{{ route('friend.search') }}">
        <input type="text" class="form-control mb-2 mr-sm-2 " id="query" name="query">
        <button type="submit" class="btn btn-primary mb-2 app-primary-bg">Buscar</button>
    </form>

    <div class="search-friend-container app-container">
        @foreach($profiles as $profile)
        <div class="text-center">
            <div class="app-rounded-image-2">
                <img src="{{ URL::to($profile->img_uri) }}" alt="profile-picture">
            </div>
            <h6>{{ $profile->username }}</h6>
            <a href="{{ route('profile.index',['id' => $profile->id]) }}" class="btn btn-small app-btn-primary btn-rounded-border app-font-size-3">Ver perfil</a>
        </div>
        @endforeach
    </div>
@endsection