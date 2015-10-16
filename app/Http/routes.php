<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	return view('app');
});

Route::post('oauth/access_token', function(){
	return Response::json(Authorizer::issueAccessToken());
});



Route::group(['middleware' => 'oauth'], function (){

	Route::resource('client', 'ClientController', ['except' => ['create','edit']]);
	
	
	Route::resource('project', 'ProjectController', ['except' => ['create','edit']]);
	

	Route::group(['prefix' => 'project/{id}'], function(){

		Route::group(['prefix' => 'note'], function(){
			Route::get('{noteId}', 		'ProjectNoteController@show');
			Route::put('{noteId}', 		'ProjectNoteController@update');
			Route::delete('{noteId}', 	'ProjectNoteController@destroy');
			Route::get('', 				'ProjectNoteController@index');
			Route::post('', 			'ProjectNoteController@store');
		});

		Route::group(['prefix' => 'task'], function(){
			Route::get('{taskId}', 		'ProjectTaskController@show');
			Route::put('{taskId}', 		'ProjectTaskController@update');
			Route::delete('{taskId}', 	'ProjectTaskController@destroy');
			Route::get('', 				'ProjectTaskController@index');
			Route::post('', 			'ProjectTaskController@store');
		});

		Route::group(['prefix' => 'member'], function(){
			Route::get('{memberId}', 	'ProjectMemberController@show');
			Route::delete('{memberId}', 'ProjectMemberController@destroy');
			Route::get('', 				'ProjectMemberController@index');
			Route::post('', 			'ProjectMemberController@store');
		});

		Route::group(['prefix' => 'file'], function(){
			Route::get('{fileId}',   	'ProjectFileController@show');
			Route::delete('{fileId}',   'ProjectFileController@destroy');
			Route::get('',				'ProjectFileController@index');
			Route::post('',				'ProjectFileController@store');
		});
	});
});
