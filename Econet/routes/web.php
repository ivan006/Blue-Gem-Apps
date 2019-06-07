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
  Route::resource('/Assets', 'Assets');
  // Route::resource('', 'Assets');
  Route::post(  '/SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',     'SubAssets@store')->name('SubAssets.store');
  Route::get(   '/SubAssets',                                        'SubAssets@index')->name('SubAssets.index');
  Route::get(   '/SubAssets/create',                                 'SubAssets@create')->name('SubAssets.create');
  Route::patch( '/SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',     'SubAssets@update')->name('SubAssets.update');
  Route::delete('/SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',     'SubAssets@destroy')->name('SubAssets.destroy');
  Route::get(   '/SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',     'SubAssets@show')->name('SubAssets.show');
  Route::get(   '/SubAssets/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}/edit','SubAssets@edit')->name('SubAssets.edit');
});

// Route::get('/SubAssetsEdit/{a?}/{b?}', 'SubAssets@edit');
// Route::post('/SubAssets/{a?}/{b?}', 'SubAssets@store');
// Route::get('/SubAssets/{a?}/{b?}', 'SubAssets@show')->middleware('ivans');
// Route::get('/SubAssetsApi/{a?}/{b?}/{c?}/{d?}', 'blogApi@show');
// Route::get('/', 'Assets@show');
// Route::get('/create', 'Assets@create');
