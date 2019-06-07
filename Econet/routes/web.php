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
  Route::resource('/SubAssets','SubAssets');
});

// Route::get('/SubAssetsEdit/{a?}/{b?}', 'SubAssets@edit');
// Route::post('/SubAssets/{a?}/{b?}', 'SubAssets@store');
// Route::get('/SubAssets/{a?}/{b?}', 'SubAssets@show')->middleware('ivans');
// Route::get('/SubAssetsApi/{a?}/{b?}/{c?}/{d?}', 'blogApi@show');
// Route::get('/', 'Assets@show');
// Route::get('/create', 'Assets@create');
