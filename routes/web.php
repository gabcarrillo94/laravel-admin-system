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

Route::get('/', 'HomeController@index')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/photo', 'DataController@photo')->name('photo')->middleware('auth');

Route::get('users/{id}', 'DataController@users')->name('data.users')->middleware('auth');

Route::post('upload', 'DataController@uploadPhotos')->name('data.uploadPhotos');

Route::post('questionnaire', 'QuestionnaireController@store')->name('questionnaire.store');
Route::post('questionnaire/store', 'QuestionnaireController@store')->name('questionnaire.store');
Route::get('questionnaire', 'QuestionnaireController@index')->name('questionnaire.index')->middleware('auth');
Route::get('questionnaire/create', 'QuestionnaireController@create')->name('questionnaire.create');

Route::post('data/calculatorjp7', 'DataController@jp7')->name('data.calculatorjp7');
Route::post('data/calculatorpcm', 'DataController@pcm')->name('data.calculatorpcm');
Route::post('data/calculatorntm', 'DataController@ntm')->name('data.calculatorntm');

Route::post('search', 'DataController@search')->name('data.search');
Route::post('users/search', 'DataController@search')->name('data.searchUsers');
Route::post('data', 'DataController@store')->name('data.store');
Route::post('data/store', 'DataController@store')->name('data.store');
Route::get('data', 'DataController@index')->name('data.index')->middleware('auth');
Route::get('data/create', 'DataController@create')->name('data.create');
Route::get('data/{id}', 'DataController@show')->name('data.show')->middleware('auth');
Route::put('data/{id}', 'DataController@update')->name('data.update')->middleware('auth');
Route::delete('data/{id}', 'DataController@destroy')->name('data.destroy')->middleware('auth');
Route::get('data/{id}/edit', 'DataController@edit')->name('data.edit')->middleware('auth');
Route::post('data/list', 'DataController@list')->name('data.list')->middleware('auth');
