@if(!$followers == null || count($followers) > 0)
    @foreach($followers as $follower)
        <li class="friend-box" data-user-id="{{ $follower->id }}">
            <div class="friend-img-container">
                <img src="{{ URL::to($follower->img_uri) }}" />
            </div>

            <div class="friend-info">
                <a href="{{ route('profile.index', ['id' => $follower->id]) }}" class="friends-name">{{ $follower->username }}</a>
                <p class="num-of-friends">Seguidores: {{ $follower->totalFollowers }}</p>
            </div>
        </li>
    @endforeach
@endif