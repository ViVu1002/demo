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

Route::resource('user','UserController');
Route::get('login/user','UserController@createLogin');
Route::post('login/post/user','UserController@storeLogin');
Route::get('logout','UserController@logout');
Route::get('/auth/google','UserController@redirect');
Route::get('/auth/google/callback','UserController@callback');
Route::get('person_ajax','PersonController@routineEdit');
Route::resource('person','PersonController',['parameters' => ['person'=>'id']]);
Route::delete('person/delete/{person_id}/{subject_id}','PersonController@deletePoint');
Route::resource('subject','SubjectController');
Route::resource('faculty','FacultyController');
Route::resource('point','PointController');
Route::resource('home','HomeController');
Route::post('person/point/{id}','PersonController@createOrUpdate');
Route::get('/test', 'MailController@test');
