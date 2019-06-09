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

Route::group(['middleware' => 'ivans'], function() {

  Route::get('/', function(){
    return redirect( route('Assets.index'));
  });
  // Route::resource('/Assets', 'Assets');
  // Route::post(  '/Assets',        'Assets@store')->name('Assets.store');
  // Route::get(   '/Assets/index',  'Assets@index')->name('Assets.index');
  // Route::get(   '/Assets/create', 'Assets@create')->name('Assets.create');
  // Route::patch( '/Assets/update', 'Assets@update')->name('Assets.update');
  // Route::delete('/Assets/destroy','Assets@destroy')->name('Assets.destroy');
  // Route::get(   '/Assets/show',   'Assets@show')->name('Assets.show');
  // Route::resource('', 'Assets');
  Route::post(  '/Assets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',        'Assets@store')->name('Assets.store');
  Route::get(   '/Assets/index',                                           'Assets@index')->name('Assets.index');
  Route::get(   '/Assets/create',                                    'Assets@create')->name('Assets.create');
  Route::patch( '/Assets/update/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'Assets@update')->name('Assets.update');
  Route::delete('/Assets/destroy/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}','Assets@destroy')->name('Assets.destroy');
  Route::get(   '/Assets/show/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@show')->name('Assets.show');
});
Route::get(   '/Assets/edit/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'Assets@edit')->name('Assets.edit');

// Route::get('/AssetsEdit/{a?}/{b?}', 'Assets@edit');
// Route::post('/Assets/{a?}/{b?}', 'Assets@store');
// Route::get('/Assets/{a?}/{b?}', 'Assets@show')->middleware('ivans');
// Route::get('/AssetsApi/{a?}/{b?}/{c?}/{d?}', 'blogApi@show');
// Route::get('/', 'Assets@show');
// Route::get('/create', 'Assets@create');
