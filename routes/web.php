<?php

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


Route::group(['middleware' => 'web'], function() {
	Route::get('/', function () {
    	return view('welcome');
	})->name('home');

    //signup post route
    Route::post('/signup',[
    	'uses'=>'UserController@doSignUp',
    	'as'=>'signup'
    ]);
    //login post route
    Route::post('/login',[
    	'uses'=>'UserController@doLogin',
    	'as'=>'login'
    ]);

    Route::get('/dashboard',[
    	'as'=>'dashboard',
    	'uses'=>'UserController@getDashboard',
    	'middleware'=> 'auth'
    ]);

    //POST
    Route::post('/createpost',[
    	'as'=>'post.create',
    	'uses'=>'PostController@createPost'
    ]);
});
