<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Relationship;

class PostController extends SocialNetworkController
{
    public function index(){        
        $posts = Post::select("posts.id","posts.created_at","posts.updated_at","posts.content","posts.img_uri","posts.active","posts.status_type","posts.user_id")
        ->distinct()
        ->join('relationships', 'posts.user_id', '=', 'relationships.followee_id')
        ->where(function ($query) {
            $query->where('user_id','=',parent::getUserId())
                  ->orWhere([
                    ['posts.active','=',true],
                    ['relationships.follower_id','=',parent::getUserId()]
                ]);
        })
        ->orderBy('posts.created_at','desc')
        ->get();

        return view('post.index',['posts' => $posts]);
    }

    public function create(Request $request){

        $content = null;
        $img_uri = null;
        
        if($request->has('content') and strlen($request->input('content')) > 0){
            $this->validate($request,[
                'content' => 'min:1'
            ]);

            $content = $request->input('content');
        }
        
        if($request->hasFile('post_image')){
            $this->validate($request,[
                'post_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3145728',
            ]);

            $img_uri = time().'.'.$request->post_image->getClientOriginalExtension();
            $request->file('post_image')->move(public_path('assets/images/post'), $img_uri);
        }

        if($img_uri !== null or $content !== null){
            $post = Post::getPostPublishedStory(parent::getUserId(), $content, $img_uri);
            $post->save();
        }

        return redirect()->route('post.index');
    }
}
