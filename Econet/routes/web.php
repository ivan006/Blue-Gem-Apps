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

  Route::get(   '/Assets/index',                                           'Assets@index')->name('Assets.index');
  Route::get(   '/Assets/create',                                    'Assets@create')->name('Assets.create');
  Route::patch( '/Assets/update/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'Assets@update')->name('Assets.update');
  Route::delete('/Assets/destroy/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}','Assets@destroy')->name('Assets.destroy');
  Route::get(   '/Assets/show/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@show')->name('Assets.show');
});
Route::post(   '/Assets/store/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@store')->name('Assets.store');
Route::get(   '/Assets/edit/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@edit')->name('Assets.edit');
Route::get('/blogApi/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'blogApi@show');
