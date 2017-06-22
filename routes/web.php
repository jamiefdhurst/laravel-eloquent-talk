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

Route::get('simple', 'SimpleController@index');
Route::get('simple/eager', 'SimpleController@eagerLoading');
Route::get('simple/lazy', 'SimpleController@lazyLoading');
Route::get('solution/1', 'Solution1Controller@index');
Route::get('solution/1/pain', 'Solution1Controller@pain');
Route::get('solution/2', 'Solution2Controller@index');
Route::get('solution/2/pain', 'Solution2Controller@pain');
Route::get('solution/3', 'Solution3Controller@index');
Route::get('solution/3/pain', 'Solution3Controller@pain');
Route::get('/', function () {
    return view('index');
});
