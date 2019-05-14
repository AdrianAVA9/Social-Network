var PostController = function(postService){
    
    var button;
    var commentButton;
    var input;
    var commentContainer;

    var toggleLikes = function(e){
        button = $(e.target);
        var postId = button.attr('data-post-id');

        if(button.hasClass('app-primary-color'))
            postService.dislike(postId, done, fail);
        else
            postService.like(postId, done, fail);
    };

    var toggleComments = function(e){
        commentButton = $(e.target);
        var postId = commentButton.attr('data-post-id');
        commentContainer = commentButton.parents('.post-container').find('#post-comments');

        if($(commentContainer).css('display') == 'none' && 
        $(commentContainer).children('.posts-comments').children('.post-comment-element').length === 0){
            postService.comments(postId, displayComments, fail);
        }else{
            commentContainer.toggle('slow');
        }
    };

    var createComment = function(e){
        var keyCode = e.keyCode ? e.keyCode : e.which;
        input = $(e.target);
        commentContainer = input.parent().parent().parent();
        
        if(keyCode === 13){
            if(input.val().length > 0){
                var postId = input.attr('data-post-id');
                postService.createComment($('input[name="_token"]').val(),postId,input.val(),createdComment,fail);
                input.val('');
            }
        }
    }

    var createdComment  = function(data){
        if(data != null) {
            var commentDetails = JSON.parse(data);
            var comment = commentDetails[0]['comment'];
            var user = commentDetails[1]['user'];
            var userUri = commentDetails[2]['user_uri'];

            commentButton = (commentButton === undefined) ? getPostCommentButton() : commentButton;
            commentButton.text('Comentarios ' + commentDetails[3]['total']);
            addComment(userUri,user['img_uri'],user['username'],comment['created_at'],comment['description']);

            if(commentContainer.children('.posts-comments').css('display') == 'none'){
                commentContainer.children('.posts-comments').toggle();
            }
        }
    };

    var getPostCommentButton = function(){
        return commentContainer.parent().find('.post-footer').find('.js-toggle-comments');
    };

    var displayComments = function(data){
        
        if(data != null){
            var comments = JSON.parse(data);

            comments.forEach(commentDetails => {
                var comment = commentDetails[0]['comment'];
                var user = commentDetails[1]['user'];
                var userUri = commentDetails[2]['user_uri']

                addComment(userUri,user['img_uri'],user['username'],comment['created_at'],comment['description']);
            });

            commentContainer.toggle('slow');
        }
    };

    var addComment = function(profileUri, userImg, username, createdAt, description){
        var container = commentContainer.children('.posts-comments');
        $(container).append(html(profileUri,userImg,username,createdAt,description));
    };

    var done = function(data){
        data = JSON.parse(data);

        if(data['statusCode'] == 200){
            button.toggleClass('app-color-quaternary').toggleClass('app-primary-color');
            button.prev().toggleClass('app-color-quaternary').toggleClass('app-primary-color');
            button.text((data['totalLikes'] > 0) ? 'Likes ' + data['totalLikes'] : 'Likes');
        }
    };

    var fail = function(error){
        console.log('Upsss something fail');
        console.log(error);
    };

    var html = function(userUri,imgUri,username,createdAt,comment){
        var html = `<li class="media post-comment-element">
                    <div class="app-rounded-image-1 mr-3">
                        <img src="${imgUri}" alt="image">
                    </div>
                    <div class="media-body">
                        <h5 class="mt-0 mb-1 app-font-size-3"><strong><a href="${userUri}">${username}</a></strong><span class="comment-date app-font-size-1 ml-3">${createdAt}</span></h5>
                        <p class="app-font-size-3">${comment}</p>
                    </div>
                </li>`;
        return html;
    };

    var init = function(postContainer){
        $(postContainer).on("click", ".js-toggle-likes", toggleLikes);
        $(postContainer).on("click", ".js-toggle-comments", toggleComments);
        $(postContainer).on("keyup", ".js-comment-value", createComment);
    };

    return{
        init:init
    };

}(PostService);