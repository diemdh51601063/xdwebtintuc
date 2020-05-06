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


Route::get('/', function () {
    return view('welcome');
});

Route::get('a.html','nhomtinController@demo1');

*/


Route::get('admin/login.html','UserController@getlogin')->name('login');
Route::post('admin/login.html','UserController@postlogin');
Route::get('admin/logout.html','UserController@getlogout')->middleware('login');

Route::group(['prefix'=>'admin','middleware'=>'login'],function(){

  Route::group(['prefix'=>'nhomtin'],function(){

    Route::get('danhsach.html','nhomtinController@getdanhsach');
    Route::get('danhsach-{id_nhomtin}.html','nhomtinController@getdanhsachnhomtin')->name('danhsachnhomtin');

    Route::get('them.html','nhomtinController@getthem');
    Route::post('them.html','nhomtinController@postthem');

    Route::get('sua-{id_nhomtin}.html','nhomtinController@getsua');
    Route::post('sua-{id_nhomtin}.html','nhomtinController@postsua');

    Route::get('xoa-{id_nhomtin}.html','nhomtinController@getxoa');
  });


  Route::group(['prefix'=>'loaitin'],function(){

    Route::get('danhsach.html','loaitinController@getdanhsach');

    Route::get('them.html','loaitinController@getthem');
    Route::post('them.html','loaitinController@postthem');

    Route::get('sua-{id_loaitin}.html','loaitinController@getsua');
    Route::post('sua-{id_loaitin}.html','loaitinController@postsua');

    Route::get('xoa-{id_loaitin}.html','loaitinController@getxoa');
  });

  Route::group(['prefix'=>'tin'],function(){

    Route::get('danhsach.html','tinController@getdanhsach');

    Route::get('them.html','tinController@getthem');
    Route::post('them.html','tinController@postthem');

    Route::get('sua-{id_tin}.html','tinController@getsua');
    Route::post('sua-{id_tin}.html','tinController@postsua');

    Route::get('xoa-{id_tin}.html','tinController@getxoa');
  });

  Route::group(['prefix'=>'binhluan'],function(){

     Route::get('danhsach.html','binhluanController@getdanhsach');
     Route::get('danhsach1.html','binhluanController@getdanhsach1');
     Route::get('duyet-{id_binhluan}.html','binhluanController@getduyet');
     Route::get('an-{id_binhluan}.html','binhluanController@getan');
  //   Route::post('sua-{id_binhluan}.html','binhluanController@postsua');


   });

  
  	  Route::group(['prefix'=>'ajax'],function(){
      Route::get('loaitin/{id_nhomtin}','ajaxController@getloaitin');
    });



 Route::fallback(function () {
   return redirect()->route('login');
});
});
