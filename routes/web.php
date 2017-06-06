<?php

<<<<<<< HEAD
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
Auth::routes();
Route::group(['middleware' => ['guest']], function () {
    
    Route::group(['prefix' => '/'], function(){
        Route::get('/', 'HomeController@index');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'HomeController@index');      
    });
});
Route::group(['prefix' => '/admin'], function () {
    
    Route::get('/', 'HomeController@admin');
    
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/', 'HomeController@admin');
    });
});
=======
Route::get('/', function () {
    return view('welcome');
});
Route::get('/upload', 'UploadController@uploadFiles');
Route::post('/upload', 'UploadController@uploadSubmit');
>>>>>>> origin/dev
