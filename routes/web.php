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
Route::get('/blogApi/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'blogApi@show');

Route::get('/', function(){
  return redirect( route('WebDoc.index'));
});



Route::get(   '/index/webdoc',                                           'WebDoc@index')->name('WebDoc.index');
Route::get(   '/create/asset',                                    'WebDoc@create')->name('WebDoc.create');
Route::patch( '/update/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'WebDoc@update')->name('WebDoc.update');
Route::delete('/destroy/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}','WebDoc@destroy')->name('WebDoc.destroy');
Route::group(['middleware' => 'ShortcodeMiddleware'], function() {
  Route::get(   '/show/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'WebDoc@show')->name('WebDoc.show');
});
Route::post(   '/store/webdoc/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'WebDoc@store')->name('WebDoc.store');
Route::get(   '/edit/webdoc/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'WebDoc@edit')->name('WebDoc.edit');



Route::get(   '/SmartData/index/webdoc',                                           'SmartData@index')->name('SmartData.index');
Route::get(   '/SmartData/create/asset',                                    'SmartData@create')->name('SmartData.create');
Route::patch( '/SmartData/update/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}', 'SmartData@update')->name('SmartData.update');
Route::delete('/SmartData/destroy/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}','SmartData@destroy')->name('SmartData.destroy');
Route::group(['middleware' => 'ShortcodeMiddleware'], function() {
  Route::get(   '/SmartData/show/asset/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'SmartData@show')->name('SmartData.show');
});
Route::post(   '/SmartData/store/webdoc/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'SmartData@store')->name('SmartData.store');
Route::get(   '/SmartData/edit/webdoc/{a?}/{b?}/{c?}/{d?}/{e?}/{f?}/{g?}',   'SmartData@edit')->name('SmartData.edit');
