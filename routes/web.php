<?php

Route::get('/', function () {
    return view('welcome');
});
Route::get('/upload', 'UploadController@uploadFiles');
Route::post('/upload', 'UploadController@uploadSubmit');
