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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('user.dashboard');

//student section
Route::group(['prefix'=>'student'],function(){
	Route::get('/','StudentsController@login')->name('student.login');
	Route::post('/','StudentsController@dologin')->name('student.login.submit');
	Route::get('dashboard','StudentDashboardController@index')->name('student.dashboard');
	Route::get('logout','StudentDashboardController@logout');

	Route::post('checkemail','StudentsController@checkemail');
	Route::get('/register','StudentsController@create');
	Route::post('/register','StudentsController@store');
	Route::get('/profile','StudentDashboardController@profile');
    Route::post('/profile','StudentDashboardController@update_profile');
});

//teacher section
Route::group(['prefix'=>'teacher'],function(){
	Route::get('/','TeacherController@login')->name('teacher.login');
	Route::post('/','TeacherController@dologin')->name('teacher.login.submit');
	Route::get('dashboard','TeacherDashboardController@index')->name('teacher.dashboard');
	Route::get('logout','TeacherDashboardController@logout');

	Route::post('checkemail','TeacherController@checkemail');
	Route::get('/register','TeacherController@create');
	Route::post('/register','TeacherController@store');
	Route::get('/profile','TeacherDashboardController@profile');
    Route::post('/profile','TeacherDashboardController@update_profile');
});

//admin section
Route::group(['prefix'=>'admin'],function(){
	Route::get('/','AdminController@login')->name('admin.login');
	Route::post('/','AdminController@dologin')->name('admin.login.submit');
	Route::get('dashboard','AdminDashboardController@index')->name('admin.dashboard');
	Route::get('logout','AdminDashboardController@logout')->name('admin.logout');

	Route::post('checkemail','AdminController@checkemail');
	Route::get('/register','AdminController@create');
	Route::post('/register','AdminController@store');

    Route::get('/profile','AdminDashboardController@profile');
    Route::post('/profile','AdminDashboardController@update_profile');
});