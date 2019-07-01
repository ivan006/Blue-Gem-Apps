<?php

use App\User;
use App\Http\Resources\User as UserResource;
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



Route::get('/phpversion', function () {
  echo phpversion();
});

Route::group(['middleware' => 'ShortcodeMiddleware'], function() {

  Route::get('/', function(){
    return redirect( route('Post.index'));
  });

  Route::get(   '/index/post',                                           'Post@index')->name('Post.index');
  Route::get(   '/create/asset',                                    'Post@create')->name('Post.create');
  Route::patch( '/update/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'Post@update')->name('Post.update');
  Route::delete('/destroy/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}','Post@destroy')->name('Post.destroy');
  Route::get(   '/show/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Post@show')->name('Post.show');
});
Route::post(   '/store/post/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Post@store')->name('Post.store');
Route::get(   '/edit/post/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Post@edit')->name('Post.edit');
Route::get('/blogApi/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'blogApi@show');

// Route::resource('/123/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'blogApi');
