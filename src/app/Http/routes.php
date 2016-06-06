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
Route::get('/', ['as' => 'regMembers', 'uses' => 'RegistratController@form']);

Route::get('registrat/form', ['as' => 'regMembers', 'uses' => 'RegistratController@form']);
Route::get('list/show', ['as' => 'listMembers', 'uses' => 'ListController@show']);

Route::any('registrat/validat', ['as' => 'regValid', 'uses' => 'RegistratController@validat']);
Route::any('registrat/validat2', ['as' => 'regValid2', 'uses' => 'RegistratController@validat2']);

Route::get('registrat/test', ['as' => 'regTest', 'uses' => 'RegistratController@test']);

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('dashboard', [
    'as' => 'dashboard',
    /*'middleware'=> ['web','can:admin'],*/
    'uses' => 'HomeController@index',
]);



Route::any('admin/hidden', ['as' => 'hiddenMember', 'uses' => 'AdminController@HiddenMember']);



