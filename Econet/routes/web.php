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
Route::get('/postsEdit/{a?}/{b?}', 'posts@edit');
Route::post('/posts/{a?}/{b?}', 'posts@store');
Route::get('/posts/{a?}/{b?}', 'posts@show')->middleware('ivans');;
Route::get('/postsApi/{a?}/{b?}/{c?}/{d?}', 'blogApi@show');
Route::get('/', 'groups@show');
