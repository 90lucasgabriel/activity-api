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
	return view('welcome');
});

Route::post('oauth/access_token', function(){
	return Response::json(Authorizer::issueAccessToken());
});



Route::group(['middleware' => 'oauth'], function (){

	Route::resource('client', 'ClientController', ['except' => ['create','edit']]);
	
	
	Route::resource('project', 'ProjectController', ['except' => ['create','edit']]);
	

	Route::group(['prefix' => 'project'], function(){
		Route::get('project/{id}/note/{noteId}', 'ProjectNoteController@show');
		Route::put('project/{id}/note/{noteId}', 'ProjectNoteController@update');
		Route::delete('project/{id}/note/{noteId}', 'ProjectNoteController@destroy');
		Route::get('project/{id}/note', 'ProjectNoteController@index');
		Route::post('project/{id}/note', 'ProjectNoteController@store');
	});
});
