<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Project routes
Route::get('/project', 'App\Http\Controllers\ProjectController@index')->middleware('auth');
Route::get('/project/create', 'App\Http\Controllers\ProjectController@create')->middleware('auth');
Route::get('/project/{project_id}-{project_slug}', 'App\Http\Controllers\ProjectController@show')->middleware('auth')->middleware('ProjectAccessValidity');
Route::post('/project/store', 'App\Http\Controllers\ProjectController@store')->middleware('auth');
Route::delete('/project/{project_id}-{project_slug}', 'App\Http\Controllers\ProjectController@destroy')->middleware('auth')->middleware('ProjectAccessValidity');
Route::get('/project/{project_id}-{project_slug}/edit', 'App\Http\Controllers\ProjectController@edit')->middleware('auth')->middleware('ProjectAccessValidity');
Route::patch('/project/{project_id}-{project_slug}', 'App\Http\Controllers\ProjectController@update')->middleware('auth')->middleware('ProjectAccessValidity');

Route::get('/project/{project_id}-{project_slug}/share', 'App\Http\Controllers\ProjectController@shareIndex');
Route::post('/project/{project_id}-{project_slug}/share', 'App\Http\Controllers\ProjectController@share');
//Task routes
Route::get('/project/{project_id}-{project_slug}/task/create', 'App\Http\Controllers\TaskController@create')->middleware('auth')->middleware('ProjectAccessValidity');
Route::post('/project/{project_id}-{project_slug}/task/store', 'App\Http\Controllers\TaskController@store')->middleware('auth')->middleware('ProjectAccessValidity');
Route::get('/project/{project_id}-{project_slug}/task/{task_id}-{task_slug}/edit', 'App\Http\Controllers\TaskController@edit')->middleware('auth')->middleware('ProjectAccessValidity');
Route::patch('/project/{project_id}-{project_slug}/task/{task_id}-{task_slug}', 'App\Http\Controllers\TaskController@update')->middleware('auth')->middleware('ProjectAccessValidity');
Route::delete('/project/{project_id}-{project_slug}/task/{task_id}-{task_slug}', 'App\Http\Controllers\TaskController@destroy')->middleware('auth')->middleware('ProjectAccessValidity');

//User routes
Route::get('/user/{user_id}', 'App\Http\Controllers\UserController@show');
Route::get('/user/{user_id}/project/public', 'App\Http\Controllers\ProjectController@publicIndex');
Route::get('/user/{user_id}/project/shared', 'App\Http\Controllers\UserController@sharedIndex')->middleware('auth');

//user relationships routes || SHOULD ALL USE AUTH MIDDLEWARE
Route::post('/relationship', 'App\Http\Controllers\UserRelationshipController@store')->middleware('auth');
Route::delete('/relationship/{related_id}', 'App\Http\Controllers\UserRelationshipController@destroy')->middleware('auth');
Route::get('/friend', 'App\Http\Controllers\UserRelationshipController@index')->middleware('auth');
Route::get('/friend/request', 'App\Http\Controllers\UserRelationshipController@requestIndex')->middleware('auth');
Route::patch('/friend/request', 'App\Http\Controllers\UserRelationshipController@update')->middleware('auth');