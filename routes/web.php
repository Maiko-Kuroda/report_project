<?php
// use Illuminate\Support\Facades\Route;
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
// フォロー/フォロー解除を追加
Route::get('/home', 'Admin\ReportController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/user/edit', 'Admin\UserController@edit')->name('userEdit');
    Route::post('/user/update', 'Admin\UserController@update');
    Route::get('/user','Admin\UserController@yourAccount');
    Route::get('/user/index','Admin\UserController@index')->middleware('auth');
   
    Route::post('/user/follow', 'Admin\FollowController@follow');
    Route::post('/user/unfollow', 'Admin\FollowController@unfollow');

    //createで更新、addで新規登録画面、editで編集（1度投稿したものの）
    Route::get('/report/edit', 'Admin\ReportController@edit')->name('reportEdit');
    Route::post('/report/update','Admin\ReportController@update');
    Route::get('/report/add', 'Admin\ReportController@add');
    Route::post('/report/create', 'Admin\ReportController@create');
    Route::get('/report/mypage', 'Admin\ReportController@showMypage');
    Route::get('report', 'Admin\ReportController@index');

        //検索ボタンを押すとコントローラのindexメソッドを実行します
    Route::get('Search','Admin\ReportController@index')->name('search');

    Route::get('/group/add', 'Admin\GroupController@add');
    Route::post('/group/create', 'Admin\GroupController@create');
    Route::get('/group/welcome', 'Admin\GroupController@welcome');
    Route::get('/group/login', 'Admin\GroupController@enter');
    // Route::('/group/login', 'Admin\GroupController@enter');
    Route::post('/group/enter', 'Admin\GroupController@login');

    // Route::get('/{message}', 'UserController@index');

});

Auth::routes();

// ResourceControllerにすることで
// システムが自動的にそれぞれのアクションに紐づけてくれます。
// 今回のユーザ機能では一覧/詳細/編集/更新のみを使用するので
// 第３引数にonlyと記述して使うアクションのみを設定しましょう。
// // Route::resource('users', 'UsersController', ['only' => ['index', 'show', 'edit', 'update']]);