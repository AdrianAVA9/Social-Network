<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    protected $fillable = ['content', 'img_uri','active','user_id','status_type'];

    public function profiles(){
        return $this->belongsTo('\App\Profile','user_id');
    }

    public function likes(){
        return $this->hasMany('\App\Like','post_id');
    }

    public function comments(){
        return $this->hasMany('\App\Comment','post_id');
    }

    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->toFormattedDateString();
    }
    public function getImgUriAttribute($value){

        $path = '';

        if($value !== null)
        {
            switch($this->status_type){
                case 'added_photos':
                    $path = "assets/images/album/".$value;
                    break;
                case 'published_story':
                    $path = "assets/images/post/".$value;
                    break;
                case 'updated_pic':
                    $path = "assets/images/user/".$value;
                    break;
            }
        }

        return $path;
    }

    public function getPostTypeDescription(){
        
        $post_type_description = '';

        switch($this->status_type){
            case 'added_photos':
                    $post_type_description = "Agrego una foto";
                break;
            case 'published_story':
                    $post_type_description = "Nueva publicación";
                break;
            case 'updated_pic':
                    $post_type_description = "Cambio su foto de perfil";
                break;
        }

        return $post_type_description;
    }

    static public function getPostAddedPhoto($img_uri, $user_id){
        $post = new Post([
            'img_uri' => $img_uri,
            'active' => true,
            'user_id' => $user_id,
            'status_type' => 'added_photos'
        ]);

        return $post;
    }

    static public function getPostPublishedStory($user_id, $content = null, $img_uri = null){
        $post = new Post([
            'content' => $content,
            'img_uri' => $img_uri,
            'active' => true,
            'user_id' => $user_id,
            'status_type' => 'published_story'
        ]);

        return $post;
    }

    static public function getPostUpdatedProfilePicture($img_uri, $user_id){
        $post = new Post([
            'img_uri' => $img_uri,
            'active' => true,
            'user_id' => $user_id,
            'status_type' => 'updated_pic'
        ]);

        return $post;
    }
}
