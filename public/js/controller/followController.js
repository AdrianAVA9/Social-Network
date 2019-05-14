var FollowController = function(followService){

    var following = function(){
        var followeedId = $('#btn-follow').attr('data-user-id');
        var follow_status = $('#btn-follow').attr('data-follow-status');

        if(!isNaN(followeedId) && followeedId > 0){
            if(follow_status === 'follow'){
                followService.follow(followeedId, follow, fail);
            }else{
                followService.unfollow(followeedId, unfollow, fail);
            }
        }
    };

    var removeMeFromList = function(userId){
        var friendsContainers = $('#friends').children();
        console.log(friendsContainers);
        if(friendsContainers !== null){
            for(var i = 0; i < friendsContainers.length; i++){
                var element = friendsContainers[i];
                
                if($(element).attr('data-user-id') == userId){
                    $(element).fadeOut(function(){
                        this.remove();
                    });
                }
            }
        }
        
    };

    var addMeAsFollower = function(data){
        $('#friends').append(getHtmlTemplate(
            data['user']['id'],
            data['user']['username'],
            data['user']['img_uri'],
            data['total_followers'],
            data['profile_uri']
        ));
    };

    var getHtmlTemplate = function(userId, username, imgUri, totalFollowers, profileUri){

        var html = `<li class="friend-box" data-user-id="${userId}">
                        <div class="friend-img-container">
                            <img src="${imgUri}" />
                        </div>
                        <div class="friend-info">
                            <a href="${profileUri}" class="friends-name">${username}</a>
                            <p class="num-of-friends">Seguidores: ${totalFollowers}</p>
                        </div>
                    </li>`;

        return html;
    };

    var changeFollowBtn = function(){
        var follow_status = $('#btn-follow').attr('data-follow-status');
        var text = (follow_status === 'follow') ? 'Dejar de seguir' : 'Seguir';
        $('#btn-follow').text(text);
        $('#btn-follow').attr('data-follow-status', (follow_status === 'follow') ? 'unfollow' : 'follow');
    };

    var totalFollowers = function(increase){
        var total =  parseInt($('#total-followers').text());

        if(increase){
            $('#total-followers').text(total + 1)
        }else{
            $('#total-followers').text(total - 1);
        }
    };

    var follow = function(data){
        changeFollowBtn();
        totalFollowers(true);
        addMeAsFollower(JSON.parse(data));
    };

    var unfollow = function(data){
        changeFollowBtn();
        totalFollowers(false);
        removeMeFromList(data['user_id']);
    };

    var fail = function(data){
        console.log('fail');
        console.log(data);
    };

    return{
        following:following
    }
}(FollowService);