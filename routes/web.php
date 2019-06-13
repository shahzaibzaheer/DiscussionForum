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

Route::get('/', 'HomeController@home')->name('home');


Route::get('/LoginRegister',function (){
   return view('loginRegister');
})->name('loginRegister');
Auth::routes();


Route::resource('channel', 'ChannelController');



//Route::get('/home', 'HomeController@index')->name('home');
