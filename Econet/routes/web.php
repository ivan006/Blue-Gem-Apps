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

Route::resource('/example','example');
Route::get('/blogEdit/{a?}/{b?}', 'blog@edit');
Route::post('/blog/{a?}/{b?}', 'blog@store');
Route::get('/blog/{a?}/{b?}', 'blog@show')->middleware('ivans');;
Route::get('/blogApi/{a?}/{b?}/{c?}/{d?}', 'blogApi@show');
Route::get('/groups', 'blog@index');
