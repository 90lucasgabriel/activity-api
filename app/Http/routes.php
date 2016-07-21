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
	Route::get('project/queryIsMember', 		'ProjectController@queryIsMember');
	Route::resource('project', 'ProjectController');

	//Route::resource('project.member', 'ProjectMemberController', ['except' => ['create','edit', 'update']]);	
	///project/{project}/member/{member}
	
	Route::get('user/authenticated', 		'UserController@authenticated');
	Route::resource('user', 'UserController', ['except' => ['create','edit']]);	

	Route::group([ 'middleware' => 'check.project.permission','prefix' => 'project/{id}/'], function(){



		Route::group(['prefix' => 'notes'], function(){
			Route::get('{noteId}', 		'ProjectNoteController@show');
			Route::put('{noteId}', 		'ProjectNoteController@update');
			Route::delete('{noteId}', 	'ProjectNoteController@destroy');
			Route::get('', 				'ProjectNoteController@index');
			Route::post('', 			'ProjectNoteController@store');
		});

		Route::group(['prefix' => 'tasks'], function(){
			Route::get('{taskId}', 		'ProjectTaskController@show');
			Route::put('{taskId}', 		'ProjectTaskController@update');
			Route::delete('{taskId}', 	'ProjectTaskController@destroy');
			Route::get('', 				'ProjectTaskController@index');
			Route::post('', 			'ProjectTaskController@store');
		});

		Route::group(['prefix' => 'member'], function(){
			Route::delete('{projectMemberId}', 'ProjectMemberController@destroy');
			Route::get('', 				'ProjectMemberController@index');
			Route::post('', 			'ProjectMemberController@store');
		});

		Route::group(['prefix' => 'file'], function(){
			Route::get('{fileId}',   	'ProjectFileController@show');
			Route::put('{fileId}',   	'ProjectFileController@update');
			Route::get('{fileId}/download','ProjectFileController@showFile');
			Route::delete('{fileId}',   'ProjectFileController@destroy');
			Route::get('',				'ProjectFileController@index');
			Route::post('',				'ProjectFileController@store');
		});
	});
});
