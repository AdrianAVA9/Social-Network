<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return view('welcome');
})->name('home.index');

Route::get('/home', function(){
    return view('welcome');
})->name('home.index');

Route::get('search-friend', [
    'uses' => 'FriendController@search',
    'as' => 'friend.search',
    'middleware' => 'auth'
]);

Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function(){

    Route::get('my-profile', [
        'uses' => 'ProfileController@myProfile',
        'as' => 'profile.myProfile'
    ]);

    Route::get('{id}', [
        'uses' => 'ProfileController@getProfile',
        'as' => 'profile.index'
    ]);

    Route::get('{id}/album/{album_id}', [
        'uses' => 'AlbumController@index',
        'as' => 'album.index'
    ]);

    Route::delete('album/{id}',[
        'uses' => 'AlbumController@deleteAlbum',
        'as' => 'album.delete'
    ]);
    
    Route::post('album',[
        'uses' => 'AlbumController@createAlbum',
        'as' => 'album.create'
    ]);
    
    Route::post('album/image',[
        'uses' => 'AlbumController@addPhotoToAlbum',
        'as' => 'album.image'
    ]);
    
    Route::get('{id}/follow', [
        'uses' => 'API\FollowController@follow',
        'as' => 'profile.follow'
    ]);
    
    Route::get('{id}/unfollow', [
        'uses' => 'API\FollowController@unfollow',
        'as' => 'profile.unfollow'
    ]);

    Route::post('picture', [
        'uses' => 'ProfileController@changePicture',
        'as' => 'profile.image'
    ]);
});


Route::group(['prefix' => 'posts', 'middleware' => ['auth']], function(){

    Route::get('/', [
        'uses' => 'PostController@index',
        'as' => 'post.index'
    ]);

    Route::post('create',[
        'uses' => 'PostController@create',
        'as' => 'post.create'
    ]);

    Route::post('{id}/comments',[
        'uses' => 'API\CommentController@createComment',
        'post.comments.create'
    ]);

    Route::get('{id}/comments',[
        'uses' => 'API\CommentController@getComments',
        'post.comments'
    ]);

    Route::get('{id}/like', [
        'uses' => 'API\LikesController@like',
        'as' => 'post.like'
    ]);
    
    Route::get('{id}/dislike', [
        'uses' => 'API\LikesController@dislike',
        'as' => 'post.dislike'
    ]);

});

Auth::routes();
