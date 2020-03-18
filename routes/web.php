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

Route::redirect('/','/en');
//subjects
Route::resource('subject','SubjectController');
//users
Route::resource('user','UserController');
//login , password, logout
Route::get('login/user','UserController@createLogin');
Route::post('login/post/user','UserController@storeLogin');
Route::get('change-password','UserController@changePassword');
Route::post('change-password','UserController@changePasswordStore');
Route::get('change-update-password/{id}','UserController@changeUpdatePassword');
Route::post('change-update-password/{id}','UserController@changeUpdatePasswordStore');
Route::get('logout','UserController@logout');
Route::get('/auth/google','UserController@redirect');
Route::get('/auth/google/callback','UserController@callback');
//person
Route::get('person_ajax','PersonController@routineEdit');
Route::resource('person','PersonController')->except('index','show');
Route::get('person-update/{id}','PersonController@getEditPerson');
Route::post('person-update/{id}','PersonController@updateEditPerson');
Route::delete('person/delete/{person_id}/{subject_id}','PersonController@deletePoint');
//faculty
Route::resource('faculty','FacultyController');
//point
Route::resource('point','PointController');
//home
Route::resource('home','HomeController');
Route::post('person/point/{id}','PersonController@createOrUpdate');
Route::get('/test', 'MailController@test');

Route::group(['prefix' => '{language}'], function (){
    Route::get('/home','PersonController@home');
    Route::get('person','PersonController@index');
    Route::get('person/{id}','PersonController@show');
});
