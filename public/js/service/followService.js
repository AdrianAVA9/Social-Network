var FollowService = function(){
    
    var unfollow = function(followeedId, done, fail){
        $.get('/profile/'+followeedId+'/unfollow').done(done).fail(fail);
    };

    var follow = function(followeedId, done, fail){
        $.get('/profile/'+followeedId+'/follow').done(done).fail(fail);
    };

    return{
        follow:follow,
        unfollow:unfollow
    }
}();