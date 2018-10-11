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
    return view('view');
});



Route::group(['prefix' => 'account'], function(){
	Route::get('add', function(){
		echo 'Thêm account';
	});
	Route::get('edit', function(){
		echo 'Sửa account';
	});
	Route::get('del', function(){
		echo 'Xóa account';
	});
});

Route::get('login','HomeController@getLogin');
Route::post('login',['as'=>'login','uses'=>'HomeController@postLogin']);


Route::get('signup','HomeController@getSignup');
Route::post('signup',['as'=>'signup','uses'=>'HomeController@postSignup']);

Route::get('logout', 'HomeController@getLogout');

Route::get('forgetpassword','HomeController@forgetPassword');


Route::get('dashboard','HomeController@dashboard');
Route::get('accounts','HomeController@accounts');
Route::get('securenotes','HomeController@securenotes');
Route::get('sharewith','HomeController@sharewith');
Route::get('drive','HomeController@drive');
Route::get('groups','HomeController@groups');
Route::get('credential','HomeController@credential');
Route::get('setting','HomeController@setting');

Route::post('accounts/add',['as'=>'add','uses'=>'HomeController@addAccount']);
Route::post('accounts/edit',['as'=>'edit','uses'=>'HomeController@postEdit']);
Route::get('accounts/delete',['as'=>'delete', 'uses'=>'HomeController@deleteAccount']);
Route::get('share',['as'=>'share','uses'=>'HomeController@shareAccount']);
