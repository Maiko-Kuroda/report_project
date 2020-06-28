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

//createで更新、addで新規登録画面、editで編集（1度投稿したものの）
Route::get('/report/edit', 'Admin\ReportController@edit')->name('reportEdit');
Route::post('/report/update','Admin\ReportController@update');
Route::get('/report/add', 'Admin\ReportController@add');
Route::post('/report/create', 'Admin\ReportController@create');
Route::get('/report/mypage', 'Admin\ReportController@showMypage');

Route::get('report', 'Admin\ReportController@index');
Auth::routes();