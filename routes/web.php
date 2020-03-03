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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('movie/create', 'Admin\MovieController@add');
    Route::post('movie/create', 'Admin\MovieController@create');
    Route::get('movie', 'Admin\MovieController@index')->middleware('auth'); 
    Route::get('movie/edit', 'Admin\MovieController@edit')->middleware('auth'); 
    Route::post('movie/edit', 'Admin\MovieController@update')->middleware('auth'); 
    Route::get('movie/delete', 'Admin\MovieController@delete')->middleware('auth');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'MovieController@index');

//Route::get('/todos','Admin\TodosController@index'); 
//Route::resource('todos','Admin\TodosController');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('todos/create', 'Admin\TodoController@add');
    Route::post('todos/create', 'Admin\TodoController@create');
    Route::get('/todos','Admin\TodoController@index')->middleware('auth');  
    Route::get('todos/delete', 'Admin\TodoController@delete')->middleware('auth');
});
