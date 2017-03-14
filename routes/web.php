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
    	'uses'=>'PostController@getDashboard',
    	'middleware'=> 'auth'
    ]);

    //POST
    Route::post('/createpost',[
    	'as'=>'post.create',
    	'uses'=>'PostController@createPost',
        'middleware'=> 'auth'
    ]);

    //get delete post
    Route::get('/delete-post/{post_id}',[
        'as'=>'post.delete',
        'uses'=>'PostController@deletePost',
        'middleware'=> 'auth'
    ]);

    //logout User
    Route::get('/logout',[
        'as'=>'logout',
        'uses'=>'UserController@logoutUser',
    ]);

     //Account settings
    Route::get('/account',[
        'as'=>'account',
        'uses'=>'UserController@getAccount',
    ]);
    Route::post('/updateaccount',[
        'as'=>'account.save',
        'uses'=>'UserController@saveAccount',
    ]);
    Route::get('/userimage/{filename}',[
        'as'=>'account.image',
        'uses'=>'UserController@getUserImage',
    ]);

    //Update post
    Route::post('/edit',[
            'as'=>'edit',
            'uses'=>'PostController@editPost'
        ]
        /*function(\Illuminate\Http\Request $request){
        return response()->json(['message'=>$request['postId']]);
        /* 
            message:
        */
    //}
    );
    //->name('edit');
    
    //LIKE
     Route::post('/like',[
        'as'=>'like',
        'uses'=>'PostController@likePost',
    ]);


     /*ACL part*/
    Route::get('/author', [
        'uses' => 'UserController@getAuthorPage',
        'as' => 'author',
        'middleware' => 'roles',
        'roles' => ['Admin', 'Author']
    ]);
    Route::get('/author/generate-article', [
        'uses' => 'UserController@getGenerateArticle',
        'as' => 'author.article',
        'middleware' => 'roles',
        'roles' => ['Author']
    ]);
    Route::get('/admin', [
        'uses' => 'UserController@getAdminPage',
        'as' => 'admin',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);
    Route::post('/admin/assign-roles', [
        'uses' => 'UserController@postAdminAssignRoles',
        'as' => 'admin.assign',
        'middleware' => 'roles',
        'roles' => ['Admin']
    ]);

});
