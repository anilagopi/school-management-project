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

Auth::routes();

Route::get('/', 'StudentController@index')->name('student');

Route::resource('students', 'StudentController');
Route::get('students/{id}/destroy/', 'StudentController@destroy')->name('students.destroy');
Route::post('/students/{id}/update/','StudentController@update')->name('students.update');


Route::resource('student_marks', 'StudentMarkController');
Route::get('/student_marks', 'StudentMarkController@index')->name('students.marks');
Route::get('student_marks/{id}/destroy/', 'StudentMarkController@destroy')->name('student_marks.destroy');

