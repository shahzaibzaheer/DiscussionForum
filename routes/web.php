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

Route::get('/', 'DiscussionController@index')->name('index');


Route::get('/LoginRegister',function (){
   return view('loginRegister');
})->name('loginRegister');
Auth::routes();

Route::group(['prefix'=>'channel', 'as'=>'channel.'],function (){
    Route::get('/{channel}/delete','ChannelController@delete')->name('delete');

    // show discussions  filter by specific channel
    Route::get('/{channel}/discussions','ChannelController@showDiscussions')->name('discussion.show');
});
Route::resource('channel', 'ChannelController');



Route::group(['prefix'=>'user/discussion', 'as'=>'discussion.','middleware'=>'auth'],function(){

    Route::get('/create','DiscussionController@create')->name('create');
    Route::get('/{discussion}/edit','DiscussionController@edit')->name('edit');
    Route::get('/{discussion}/delete','DiscussionController@delete')->name('delete');
    Route::delete('/{discussion}','DiscussionController@destroy')->name('destroy');
    Route::put('/{discussion}','DiscussionController@update')->name('update');
    Route::post('/','DiscussionController@store')->name('store');
    Route::get('/','DiscussionController@userDiscussions')->name('userDiscussions');
});

Route::group(['prefix'=>'discussion', 'as'=>'discussion.'],function(){
    Route::get('/','DiscussionController@index')->name('index');
    Route::get('/{discussion}','DiscussionController@show')->name('show');

    Route::post('/{discussion_id}/reply/create','ReplyController@store')->name('reply.create');
    Route::post('/reply/{reply}/like','ReplyController@like')->name('reply.like');
    Route::delete('/reply/{reply}/unlike','ReplyController@unlike')->name('reply.unlike');
    Route::post('/{discussion_id}/reply/{reply}/markAsBest','ReplyController@markAsBest')->name('reply.markAsBest');
    Route::delete('/{discussion_id}/reply/removeFromBest','ReplyController@removeFromBest')->name('reply.removeFromBest');

});






//Route::resource('discussion', 'DiscussionController');



//Route::get('/home', 'HomeController@index')->name('home');
