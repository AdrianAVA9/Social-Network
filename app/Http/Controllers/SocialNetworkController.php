<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SocialNetworkController extends Controller
{
    protected function getUserId(){
        return Auth::user()->profiles->id;
    }
}
