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

Route::get('', 'QuestionsController@index');

Auth::routes();

Route::get('/home', 'QuestionsController@index')->name('home');
Route::get('email/verify/{token}', 'EmailController@verify')->name('email.verify');
Route::resource('questions', 'QuestionsController');

Route::post('questions/{question_id}/answer', 'AnswerController@store');
