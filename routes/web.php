<?php

Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){

	Route::group(['prefix' => 'verify'], function(){
		
		Route::get('/', 'HomeController@verify');

		Route::post('/', 'HomeController@verifyCodes');

		Route::get('{confirmationCode}', [
			'as' => 'confirmation_path',
			'uses' => 'HomeController@verifyCode'
		]);

		Route::get('sendEmail', 'HomeController@sendEmailVerify')->name('sendEmailVerification');

	});

	Route::group(['prefix' => 'profile'], function(){
	
		Route::get('{id}', 'HomeController@profile');

		Route::get('{id}/edit', 'HomeController@editProfile');

		Route::post('{id}/edit/save', 'HomeController@storeProfile');

		Route::get('{id}/changepass', 'HomeController@changepass');

		Route::post('{id}/savepass', 'HomeController@savepass');
	
	});
    
    Route::group(['middleware' => 'admin'], function(){

	    Route::group(['prefix' => 'add'], function(){
	    	Route::get('event', 'CompetitionController@event');
	    });
	    
	});
});


