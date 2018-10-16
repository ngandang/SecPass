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


Auth::routes();
Route::get('register/verify/{code}', 'Auth\RegisterController@verify');
Route::post('legal/terms',function () {
    return view('page.terms');
});

Route::get('accounts','HomeController@accounts');
Route::group(['prefix' => 'account', 'as' => 'account'], function(){
    Route::post('add','HomeController@addAccount');
    Route::post('edit','HomeController@editAccount');
    Route::post('delete','HomeController@deleteAccount');
    Route::post('share','HomeController@shareAccount');
});

Route::get('securenotes','HomeController@notes');
Route::group(['prefix'=>'securenote','as'=>'securenote'], function(){
    Route::post('add','HomeController@addNote');
    Route::post('edit','HomeController@editNote');
    Route::post('delete','HomeController@delNote');
});

Route::get('credential','HomeController@credential');
Route::get('dashboard','HomeController@dashboard');
Route::get('drive','HomeController@drive');
Route::get('groups','HomeController@groups');
Route::get('sharewith','HomeController@sharewith');
Route::get('setting','HomeController@setting');

Route::get('init_roles', function () {
    return App\Users::create(
        [
        'name' => 'root',
        'description' => 'Super User for who the BOSS here.',
        ],
        [
            'name' => 'admin',
            'description' => 'Admin of ',
        ],
        [
            'name' => 'user',
            'description' => 'Normal user',
        ],
        [
            'name' => 'Jane',
            'description' => 'john@jane.com',
        ]
    );
});
