<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SocialNetworkController;
use App\Profile;
use App\Relationship;

class FollowController extends SocialNetworkController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function follow($id)
    {
        $existing_user = Profile::find($id);

        if($existing_user !== null){
            $relationship = Relationship::where([
                ['follower_id','=',parent::getUserId()],
                ['followee_id','=',$id]
            ])->get();

            if(count($relationship) === 0){
                Relationship::insert([
                    'follower_id' => parent::getUserId(),
                    'followee_id' => $existing_user->id,
                ]);
                
                $profile = Profile::select('id','username','img_uri')->where('id','=', parent::getUserId())->first();
                $totalFollowers = Relationship::where('followee_id','=',parent::getUserId())->count();
                $profileUri = url('profile/'.$profile->id);

                return json_encode([
                    'user' => $profile,
                    'total_followers' => $totalFollowers,
                    'profile_uri' => $profileUri
                ]);
            }
        }

        return 400;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unFollow($id)
    {
        $relationship = Relationship::where([
            ['follower_id','=',parent::getUserId()],
            ['followee_id','=',$id]
        ])->first();

        if($relationship !== null){
            $relationship->delete();

            return ['user_id' => parent::getUserId()];
        }

        return 404;
    }
}
