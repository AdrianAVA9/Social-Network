<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    protected $fillable = [
        'username','email','location','birthday','gender','bio','img_uri','user_id'
    ];

    public $totalFollowers;

    public function users(){
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function albums(){
        return $this->hasMany('\App\Album','user_id');
    }

    public function commets(){
        return $this->hasMany('\App\Comment','user_id');
    }

    public function likes(){
        return $this->hasMany('\App\Like', 'user_id');
    }

    public function posts(){
        return $this->hasMany('\App\Post','user_id');
    }
    public function followers()
    {
        return $this->belongsToMany(Profile::class, 'relationships', 'followee_id', 'follower_id')->withTimestamps();
    }

    public function followee(){
        return $this->belongsToMany(Profile::class, 'relationships', 'follower_id', 'followee_id')->withTimestamps();
    }
    
    public function getImgUriAttribute($value){
        return url("assets/images/user/".$value);
    }

    public function getBirthdayAttribute($value){
        $date = Carbon::parse($value);
        return $date->toFormattedDateString();
    }

    static public function getFullImgUri($img_uri){
        return "assets/images/user/".$img_uri;
    }

    public function getGenderAttribute($value){
        return ($value == 'F') ? 'Femenino' : 'Masculino';
    }
}
