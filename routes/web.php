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
Route::get('register/verify',function () {
    $status=false;

    return view('auth.verify', compact('status'));
});
Route::post('register/verify','Auth\RegisterController@sendmail');

Route::post('legal/terms',function () {
    return view('page.terms');
});

Route::get('accounts','HomeController@accounts');
Route::group(['prefix' => 'account', 'as' => 'account'], function(){
    Route::post('add','HomeController@addAccount');
    Route::post('edit','HomeController@editAccount');
    Route::post('delete','HomeController@deleteAccount');
    Route::post('share','HomeController@shareAccount');
    Route::post('generate','HomeController@generatePassword');
});

Route::get('securenotes','HomeController@notes');
Route::group(['prefix'=>'securenote','as'=>'securenote'], function(){
    Route::post('add','HomeController@addNote');
    Route::post('edit','HomeController@editNote');
    Route::post('delete','HomeController@delNote');
});

Route::get('drive','HomeController@drive');
Route::group(['prefix'=>'drive','as'=>'drive'], function(){
    Route::post('add','HomeController@addFile');
    Route::post('delete','HomeController@delFile');
    Route::post('download','HomeController@downloadFile');
});


Route::get('credential','HomeController@credential');
Route::get('dashboard','HomeController@dashboard');
Route::get('groups','HomeController@groups');
Route::get('sharewith','HomeController@sharewith');
Route::get('settings','HomeController@settings');
Route::get('profiles','HomeController@profiles');

Route::get('email','HomeController@sendMail');

Route::get('test',function(){
    return view('page.test');
});
Route::get('init_roles', function () {
    App\Roles::create(
        [
            'id' => '5bdf5220-d75c-11e8-843b-a7f6cbee423d',
            'name' => 'root',
            'description' => 'Super User for who the BOSS here.',
        ]);
    App\Roles::create(
        [
            'id' => '5bed2760-d75c-11e8-8098-a930bf45516a',
            'name' => 'admin',
            'description' => 'Admin who under root',
        ]);
    App\Roles::create(
        [
            'id' => '5bf9dea0-d75c-11e8-965c-95bc72799a6b',
            'name' => 'user',
            'description' => 'Normal user',
        ]);

    App\Users::create(
        [
            'name' => 'root',
            'email' => 'master@secpass.com',
            'role_id' => '5bdf5220-d75c-11e8-843b-a7f6cbee423d',
        ]);
        
    return 'Roles created. Good to go !!';

});
