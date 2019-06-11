<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Profile;
use App\Image;
use App\Album;
use App\Post;

class AlbumController extends SocialNetworkController
{
    public function index($id,$album_id){
        $albums = [];

        if(parent::getUserId() != $id){
            $albums = Album::where([
                ['user_id','=',$id],
                ['active','=', true],
                ['is_public','=',true]
            ])->get();
        }else{
            $albums = Album::where([
                ['user_id','=',$id],
                ['active','=', true]
            ])->get();
        }
        $album = null;

        if(is_numeric($album_id) and $album_id > 0){
            if($albums->contains('id',$album_id)){
                $album = Album::where('id','=',$album_id)->first();
            }
        }elseif(count($albums) > 0){
            $album = $albums[0];
        }

        return view('album.index',[
            'albums' => $albums,
            'album' => $album,
            'is_mine' => (parent::getUserId() != $id) ? false : true]);
    }

    public function createAlbum(Request $request){
        
        if($request->has('album_name')){
            $album_name = $request->input('album_name');

            if($album_name !== ''){
                $album = new Album([
                    'name' => $album_name,
                    'active' => true,
                    'is_public' => $request->has('is_public'),
                    'user_id' => parent::getUserId()
                ]);

                $album->save();
            }
        }

        return redirect()->route('album.index',['id' => parent::getUserId(),'album_id' => $album->id]);
    }

    public function deleteAlbum($id){
        $album = Album::where([
            ['id','=',$id],
            ['active','=',true]
        ])->first();

        if($album != null){
            if($album->user_id === parent::getUserId()){
                $album->active = false;
                $album->save();

                return response()->json("the album was deleted successfully",204);
            }else{
                return response()->json("Error", 401);
            }
        }
        
        return response()->json("Error", 404);
    }

    public function addPhotoToAlbum(Request $request){
        if($request->has('album-id')){

            $existing_album = null;

            $existing_album = Album::where([
                ['user_id','=',parent::getUserId()],
                ['id','=',$request->input('album-id')]
            ])->first();

            if($existing_album !== null){

                $this->validate($request,[
                    'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3145728',
                ]);

                $img_uri = time().'.'.$request->file->getClientOriginalExtension();
                $request->file('file')->move(public_path('assets/images/album'), $img_uri);
                
                /* $uri = Storage::disk('public')->put('images/album', $request->file('file'));
                $uri_split = explode("/", $uri);
                $img_uri = end($uri_split); */

                $image = Image::insert([
                    'name' => $img_uri,
                    'img_uri' => $img_uri,
                    'album_id' => $existing_album->id
                ]);
                
                if($existing_album->is_public == true){
                    $post = Post::getPostAddedPhoto($img_uri, parent::getUserId());
                    $post->save();
                }
            }
        }

        return redirect()->route('album.index',['id' => parent::getUserId(),'album_id' => $request->input('album-id')]);
    }
}
