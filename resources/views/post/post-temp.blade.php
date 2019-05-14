<ul class="posts" id="userPosts"> 
@foreach($posts as $post)     
    <li class="post-container">
        <div class="post-header">
            <div class="post-user-img-contianer">
                <img src="{{ URL::to($post->profiles->img_uri) }}" />
            </div>
            <div class="post-info">
                <h6 class="post-info-username"><a href="{{ route('profile.index',['id' => $post->profiles->id]) }}">{{ $post->profiles->username }}<a/><span class="post-type-description ml-3">{{ $post->getPostTypeDescription() }}</span></h6>
                <p class="post-info-date">{{ $post->created_at }}</p>
            </div>
        </div>

        <div class="post-body">
            @if($post->img_uri !== '')
                <div class="post-image">
                    <img src="{{ URL::to($post->img_uri) }}" />
                </div>
            @endif
            @if(!$post->content == '')
                <div class="post-details">
                    <p>{{ $post->content }}</p>
                </div>
            @endif
        </div>

        <div class="post-footer text-center">
            <i class="fas fa-comments pt-1 app-color-quaternary app-font-size-2"></i><button id="btn-post-comment" class="btn btn-link app-color-quaternary mr-4 js-toggle-comments" data-post-id="{{ $post->id }}">Comentarios {{ (count($post->comments) > 0) ? count($post->comments) : ''}}</button>
            <i class="fas fa-thumbs-up pt-1 {{ $post->likes->contains('user_id', Auth::user()->profiles->id) ? 'app-primary-color' : 'app-color-quaternary' }} app-font-size-2"></i><button id="btn-post-like" class="btn btn-link {{ $post->likes->contains('user_id', Auth::user()->profiles->id) ? 'app-primary-color' : 'app-color-quaternary' }} js-toggle-likes" data-post-id="{{ $post->id }}">Likes  {{ (count($post->likes) > 0) ? count($post->likes) : '' }}</button>
        </div>

        <?php $numberOfPostComments = $post->comments()->where('active','=',true)->count() ?>

        <div id="post-comments" class="{{ ($numberOfPostComments > 4) ? 'hidden' : '' }}">
            <ul class="list-unstyled px-2 py-2 posts-comments {{ ($numberOfPostComments === 0) ? 'hidden' : '' }}">
                @if($numberOfPostComments > 0 and $numberOfPostComments < 5)
                    @foreach($post->comments()->where('active','=',true)->orderBy('created_at','asc')->get() as $comment)
                        <li class="media post-comment-element">
                            <div class="app-rounded-image-1 mr-3">
                                <img src="{{ URL::to($comment->profiles->img_uri) }}" alt="image">
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0 mb-1 app-font-size-3"><strong><a href="#">{{ $comment->profiles->username }}</a></strong><span class="comment-date app-font-size-1 ml-3">{{ $comment->created_at }}</span></h5>
                                <p class="app-font-size-3">{{ $comment->description }}</p>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="form-inline create-post-comment-form border border-light app-tertiary-bg" autocomplete="off">
                <div class="form-group">
                    <div class="app-rounded-image ml-3 mx-2">
                        <img src="{{ URL::to(Auth::user()->profiles->img_uri) }}" alt="profile picture">      
                    </div>
                </div>
                <div class="form-group input-comment">
                    <input type="text" class="form-control app-font-size-3 js-comment-value" id="comment-content" data-post-id="{{ $post->id }}" name="comment" placeholder="Añadir un comentario">
                </div>
                {{ csrf_field() }}
            </div>
        </div>
    </li>
@endforeach
</ul>

<script src="{{ URL::to('js/service/postService.js') }}"></script>
<script src="{{ URL::to('js/controller/postController.js') }}"></script>
<script>
    $('document').ready(function(){
        PostController.init($('#userPosts'));
    });
</script>