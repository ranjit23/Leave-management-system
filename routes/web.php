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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/timetable', 'TimetableController@index');
Route::post('/timetable', 'TimetableController@store');

Route::get('/timetable/create', 'TimetableController@create');
Route::get('/timetable/init', 'TimetableController@init');

Route::get('/leave', 'LeaveController@index');
Route::post('/leave', 'LeaveController@store');

Route::get('/leave/create', 'LeaveController@create');

Route::get('/leave/{leave}/approve', 'LeaveController@approve');
Route::get('/leave/{leave}/decline', 'LeaveController@decline');

Route::get('/assign/{assign}/approve', 'AssignController@approve');
Route::get('/assign/{assign}/decline', 'AssignController@decline');

Route::get('/assign/{assign}/approvehod', 'AssignController@approveHod');
Route::get('/assign/{assign}/declinehod', 'AssignController@declineHod');

Route::get('/leave/{leave}/assign', 'AssignController@index');
Route::get('/assign/{leave}/store', 'AssignController@store');

Route::get('/assign/{assign}', 'AssignController@create');
Route::get('/assign/{assign}/{user}', 'AssignController@request');