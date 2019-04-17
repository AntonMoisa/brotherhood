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

Route::post('login', 'Auth\LoginController@login')->name('login.admin');

Auth::routes();

Route::group(['namespace' => 'Forum'], function(){
	Route::get('/setlocale/{locale}', 'HomeController@setlocale')->name('change.locale');
	Route::get('/', 'HomeController@index')->name('forum.home');
	Route::get('/getImage/{slug}', 'HomeController@getImage')->name('forum.image');
    Route::post('/sendMail', 'HomeController@sendMail')->name('forum.home.mail');
    Route::get('/language', 'HomeController@selectedLanguage');
});

Route::group(['namespace' => 'Forum', 'prefix' => 'art'], function(){
    Route::get('/', 'ArtController@index')->name('forum.art.show');
});

Route::group(['namespace' => 'Forum', 'prefix' => 'project'], function(){
    Route::get('/{id}', 'ProjectController@index')->name('forum.project');
    Route::get('/{id}/loadpost', 'ProjectController@loadPost')->name('forum.project.load_post');
    Route::post('/{id}/newpost', 'ProjectController@newPost')->name('forum.project.new_post');
});

Route::group(['namespace' => 'Forum\Admin',  'prefix' => 'admin',  'middleware' => 'roles',
    'roles' => ['Admin', 'Author', 'Moderator']], function (){
	Route::get('/projects/project_slug', 'DashboardController@projectSlug');
	Route::get('/{slug}/databaseBackup', 'DatabaseBackup@handle');
	Route::get('/{slug}/show', 'UserController@show');
	Route::get('/{slug}/newOrEditUser', 'UserController@newOrEditUser');
	Route::post('/{slug}/update', 'UserController@updateUser');
	Route::get('/{slug}/deleteUser', 'UserController@deleteUser');
	Route::get('/{slug}/project_cards', 'DashboardController@index');
	Route::get('/settings/{slug}', 'DashboardController@settings');
	Route::get('/projects/{slug}/{publish}/posts', 'PostController@index');
	Route::get('/projects/{slug}/{publish}/editPost', 'PostController@editPost');
	Route::post('/projects/{slug}/{publish}/createNewPost', 'PostController@createNewPost');
	Route::post('/projects/{slug}/{publish}/updatePost', 'PostController@updatePost');
	Route::get('/projects/{slug}/{publish}/deletePost', 'PostController@deletePost');
	Route::post('/projects/{slug}/{publish}/searchCountry', 'PostController@searchCountry');
	Route::post('/projects/{slug}/{publish}/searchUser', 'PostController@searchUser');
	Route::get('/projects/{slug}/{publish}/rePublish', 'PostController@rePublish');
	Route::get('/{slug}', function () { return view('forum.admin.layouts.admin');})->where('slug', '[\/\w\.-]*');
});
