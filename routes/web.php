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
<<<<<<< HEAD
Route::get('register/verify/{code}', 'Auth\RegisterController@verify');
=======
Route::get('register/verify/{code}','LoginController@verify');
Route::post('legal/terms',"LoginController@terms");
>>>>>>> f6192ca196ff0b84b491fc416f678fb7808488fd

Route::get('accounts','HomeController@accounts');
// Route::group(['prefix' => 'account'], function(){
//     Route::post('add','HomeController@addAccount');
//     Route::post('edit','HomeController@editAccount');
//     Route::post('delete','HomeController@deleteAccount');
//     Route::post('share','HomeController@shareAccount');
// });
Route::post('account/add',['as'=>'add','uses'=>'HomeController@addAccount']);
Route::post('account/edit',['as'=>'edit','uses'=>'HomeController@postEdit']);
Route::post('account/delete',['as'=>'delete', 'uses'=>'HomeController@deleteAccount']);
Route::post('account/share',['as'=>'share','uses'=>'HomeController@shareAccount']);

Route::group(['prefix'=>'securenotes','as'=>'securenotes'], function(){
    Route::post('add','HomeController@addNote');
    Route::post('edit','HomeController@editNote');
    Route::post('delete','HomeController@delNote');
});
// Route::post('securenotes/add',['as'=>'add','uses'=>'HomeController@addNote']);
// Route::post('securenotes/add',['as'=>'add','uses'=>'HomeController@addNote']);

Route::get('credential','HomeController@credential');
Route::get('dashboard','HomeController@dashboard');
Route::get('drive','HomeController@drive');
Route::get('groups','HomeController@groups');
Route::get('sharewith','HomeController@sharewith');
Route::get('securenotes','HomeController@securenotes');
Route::get('setting','HomeController@setting');

Route::get('roles', function () {
    return App\Users::create(
        [
        // 'id' => Uuid::generate(),
        'name' => 'root',
        'description' => 'Super User for who the BOSS here.',
        ],
        [
            // 'id' => Uuid::generate(),
            'name' => 'admin',
            'description' => 'Admin of ',
        ],
        [
            // 'id' => Uuid::generate(),
            'name' => 'user',
            'description' => 'Normal user',
        ],
        [
            // 'id' => Uuid::generate(),
            'name' => 'Jane',
            'description' => 'john@jane.com',
        ]
    );
});
