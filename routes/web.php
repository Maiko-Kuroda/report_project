<?php

use Illuminate\Support\Facades\Route;

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

// Route::group(['prefix'=>'admin'],function(){
    // Route::get('report/create',
    // 'Admin\ReportController@add')->middleware('auth');

    // Route::get('profile/create',
    // 'Admin\ProfileController@add')->middleware('auth');
    // Route::get('profile/edit',
    // 'Admin\ProfileController@add');
// });


Route::get('/user/edit', 'Admin\UserController@edit')->name('userEdit');
Route::post('/user/update', 'Admin\UserController@update');
Route::get('/user','Admin\UserController@yourAccount');

Route::get('/report/edit', 'Admin\ReportController@edit')->name('reportEdit');
Route::get('/report/add', 'Admin\ReportController@add');
Route::post('/report/create', 'Admin\ReportController@create');

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();