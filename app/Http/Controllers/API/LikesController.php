<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SocialNetworkController;
use App\Post;
use App\Like;

class LikesController extends SocialNetworkController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function like($id)
    {
        $existing_post = Post::find($id);
        
        if($existing_post !== null){
            $like = Like::where([
                ['user_id','=',parent::getUserId()],
                ['post_id','=',$existing_post->id]
            ])->first();
            
            if($like === null){
                Like::insert([
                    'user_id' => parent::getUserId(),
                    'post_id' => $existing_post->id,
                ]);

                $totalLikes = Like::where('post_id','=',$id)->count();

                return json_encode(['statusCode' => 200,'totalLikes' => $totalLikes]);
            }
        }

        return json_encode(['statusCode' => 400,'totalLikes' => -1]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dislike($id)
    {
        $like = Like::where([
            ['user_id','=',parent::getUserId()],
            ['post_id','=',$id]
        ])->first();

        if($like !== null){
            $like->delete();

            $totalLikes = Like::where('post_id','=',$id)->count();

            return json_encode(['statusCode' => 200,'totalLikes' => $totalLikes]);
        }

        return json_encode(['statusCode' => 400,'totalLikes' => -1]);
    }
}
