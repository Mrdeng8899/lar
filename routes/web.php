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

//
//// admin登入的路由
//Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
//       // 登入展示
////    Route::get('login','LoginController@index')->name('login');
//        // 用户点击登入的业务逻辑
//    Route::post('index','LoginController@login')->name('login.index');
//});
// 添加页面的展示
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){

    Route::get('login','UserController@login')->name('admin.login');
    Route::post('index','UserController@list')->name('login.list');
    Route::group(['middleware'=>['login']],function (){
        Route::get('index','UserController@index')->name('user.index');
        Route::post('save','UserController@save')->name('user.save');
        Route::get('create','UserController@create')->name('user.create');
        Route::post('search','UserController@search')->name('admin.search');
        Route::get('del/{id}','UserController@del')->name('user.del');
        Route::get('show','UserController@show')->name('admin.show');
        Route::get('os/{id}','UserController@os')->name('admin.os');
        Route::get('de/{id}','UserController@de')->name('admin.de');
        Route::get('edit/{id}','UserController@edit')->name('admin.edit');
        route::post('update/{id}','UserController@update')->name('admin.update');
    });
});
