<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['name','img_uri','album_id'];

    public function getImgUriAttribute($value){
        return 'assets/images/album/'.$value;
    }
}
