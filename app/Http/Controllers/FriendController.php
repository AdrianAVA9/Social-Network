<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;

class FriendController extends SocialNetworkController
{
    public function search(Request $request){

        $profiles = [];

        if($request->has('query')){

            $query = $request->input('query');

            if($query !== null){
                $profiles = Profile::where('username','like',"%{$query}%")->get();
            }else{
                $profiles = Profile::all();
            }
        }        

        return view('friend.search-friend',['profiles' => $profiles]);
    }
}
