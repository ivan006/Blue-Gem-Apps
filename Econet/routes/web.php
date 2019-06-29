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
    return redirect( route('Assets.index'));
  });

  Route::get(   '/index/assets',                                           'Assets@index')->name('Assets.index');
  Route::get(   '/create/asset',                                    'Assets@create')->name('Assets.create');
  Route::patch( '/update/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'Assets@update')->name('Assets.update');
  Route::delete('/destroy/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}','Assets@destroy')->name('Assets.destroy');
  Route::get(   '/show/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@show')->name('Assets.show');
});
Route::post(   '/store/assets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@store')->name('Assets.store');
Route::get(   '/edit/assets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@edit')->name('Assets.edit');
Route::get('/blogApi/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'blogApi@show');

// Route::resource('/123/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'blogApi');
