<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['name','active','is_public','user_id'];

    public function images(){
        return $this->hasMany('\App\Image','album_id');
    }

    public function profiles(){
        return $this->belongsTo('\App\Profile','user_id');
    }
}
