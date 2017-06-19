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

	    Route::group(['prefix' => 'competition'], function(){

	    	Route::get('add', 'CompetitionController@competition');

	    	Route::post('save', 'CompetitionController@saveCompetition');

	    	Route::get('{id}/manage', 'CompetitionController@manage');

	    	Route::get('{id}/list', 'CompetitionController@userList');

	    });

	    Route::group(['prefix' => 'attachment'], function(){

		    Route::get('{id}/validate', 'CompetitionController@validateAttachment');

		    Route::post('{id}/validate', 'CompetitionController@validating');

		    Route::post('{id}/accept', 'CompetitionController@accept');

		});
	    
	    Route::get('user/list', 'UserController@userList');

	});
    
    Route::group(['middleware' => 'user'], function(){
	
    	Route::group(['prefix' => 'competition'], function(){

	    	Route::get('{id}/join', 'CompetitionController@join');

	    	Route::post('{id}/join', 'CompetitionController@upload');

	    });

    	Route::group(['prefix' => 'attachment'], function(){

			Route::get('{id}/revision', 'CompetitionController@revision');

			Route::post('{id}/revision', 'CompetitionController@revise');

	    });

	});

    Route::group(['prefix' => 'attachment'], function(){

		Route::get('{id}/view', 'CompetitionController@viewAttachment');
			
		Route::get('{id}/view/ktp', 'CompetitionController@viewKtp');

		Route::get('{id}/view/surat', 'CompetitionController@viewPdf');

		Route::get('{id}/view/karya/{no}', 'CompetitionController@viewKarya');
    
    });

});


