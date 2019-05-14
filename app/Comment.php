<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Comment extends Model
{
    protected $fillable = ['description','user_id','post_id','active'];

    public function posts(){
        return $this->belongsTo('\App\Post','post_id');
    }

    public function profiles(){
        return $this->belongsTo('\App\Profile','user_id');
    }

    public function getCreatedAtAttribute($value){
        $date = Carbon::parse($value);
        return $date->toFormattedDateString();
    }
}
