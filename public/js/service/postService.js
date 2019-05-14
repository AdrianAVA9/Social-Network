var PostService = function(){

    var like = function(postId, done, fail){
        $.get('/posts/'+postId+'/like').done(done).fail(fail);
    };

    var dislike = function(postId, done, fail){
        $.get('/posts/'+postId+'/dislike').done(done).fail(fail);
    };
    
    var comments = function(postId, done, fail){
        $.get('/posts/'+postId+'/comments').done(done).fail(fail);
    };

    var createComment = function(token, postId, description, done, fail){
        $.post('/posts/'+postId+'/comments',{
            '_token':token,
            'post_id':postId,
            'description':description
        }).done(done).fail(fail);
    };

    return{
        like:like,
        dislike:dislike,
        comments:comments,
        createComment:createComment,
    };
}();