<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\SocialNetworkController;
use App\Post;
use App\Comment;
use Carbon\Carbon;

class CommentController extends SocialNetworkController
{
    public function getComments($id){

        $post = Post::where([
            ['id','=',$id],
            ['active','=',true]
        ])->first();

        if($post !== null){
            $comments = $post->comments()->where('active','=',true)->orderBy('created_at','asc')->get();
            $data = [];

            foreach($comments as $comment){
                $profile = $comment->profiles()->select('id','username','img_uri')->first();

                array_push($data, [
                    ['comment' => $comment],
                    ['user' => $profile],
                    ['user_uri' => url('profile/'.$profile->id)]
                ]);
            }

            return json_encode($data);
        }

        return null;
    }

    public function createComment(Request $request, $id){

        $this->validate($request,[
            'post_id' => 'required|min:1',
            'description' => 'required|min:1'
        ]);

        $postId = $request->input('post_id');
        $post = Post::where([
            ['id','=',$postId],
            ['active','=',true]
        ])->first();

        if($post !== null){
            $commentId = Comment::insertGetId([
                'description' => $request->input('description'),
                'user_id' => parent::getUserId(),
                'post_id' => $post->id,
                'active' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $comment = Comment::find($commentId);
            $profile = $comment->profiles()->select('id','username','img_uri')->first();

            return json_encode([
                ['comment' => $comment],
                ['user' => $profile],
                ['user_uri' => url('profile/'.$profile->id)],
                ['total' => Comment::where('post_id','=',$comment->post_id)->count()]
            ]);
        }

        return null;
    }

}