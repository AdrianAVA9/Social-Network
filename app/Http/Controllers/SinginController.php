<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SinginController extends Controller
{
    public function singin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt()){
            return redirect()->route('post.index');
        }

        return redirect()->back()->with(['fail' => 'Autenticacion fallida']);
    }
}
