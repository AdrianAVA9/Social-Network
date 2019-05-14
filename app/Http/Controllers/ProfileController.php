<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Profile;
use App\Relationship;
use App\Post;

class ProfileController extends SocialNetworkController
{
    public function getProfile($id){
        $profile = Profile::find($id);

        $followers = DB::table('relationships')
        ->join('profiles','relationships.follower_id','=','profiles.id')
        ->select('profiles.username','profiles.img_uri','profiles.id')
        ->where('relationships.followee_id','=',$profile->id)
        ->get();

        $profile->totalFollowers = count($followers);

        foreach($followers as $follower){
            $follower->img_uri = Profile::getFullImgUri($follower->img_uri);
            $follower->totalFollowers = count(Relationship::where('followee_id','=',$follower->id)->get());
        }

        $following = false;

        if(parent::getUserId() !== $id){
            $relationship = DB::table('relationships')->where([
                ['follower_id','=',parent::getUserId()],
                ['followee_id','=',$id]
            ])->get();

            $following = (count($relationship) > 0) ? true : false;
        }

        $posts = Post::where([
                ['user_id','=', $profile->id],
                ['active','=',true]
            ])
            ->orderBy('created_at','desc')
            ->get();

        return view('profile.index',[
            'profile' => $profile,
            'followers' => $followers,
            'posts' => $posts,
            'following' => $following
        ]);
    }

    public function myProfile(){
        return redirect()->route('profile.index',['id' => parent::getUserId()]);
    }

    public function changePicture(Request $request){
        $this->validate($request,[
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3145728'
        ]);

        $img_uri = time().'.'.$request->file->getClientOriginalExtension();
        $request->file('file')->move(public_path('assets/images/user'), $img_uri);

        Profile::where('id','=',parent::getUserId())->update([
            'img_uri' => $img_uri
        ]);

        $post = Post::getPostUpdatedProfilePicture($img_uri, parent::getUserId());
        $post->save();

        return redirect()->route('profile.index',['id' => parent::getUserId()]);;
    }
}
