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

Route::get('/projects', 'ProjectsController@index'); // GET REQUEST - ROUTE FOR PROJECTS TAKES YOU TO THE PROJECTS CONTROLLER - INDEX FUNCTION

Route::get('/projects/{project}', 'ProjectsController@show');


Route::post('/projects','ProjectsController@store'); // POST REQUEST - ROUTE FOR PROJECTS TAKES YOU TO THE PROJECTS CONTROLLER - STORE FUNCTION
