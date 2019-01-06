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
Route::post('register/pgp','Auth\RegisterController@addPGP');

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
    Route::post('detail','HomeController@getAccount');
    Route::post('add','HomeController@addAccount');
    Route::post('edit','HomeController@editAccount');
    Route::post('delete','HomeController@deleteAccount');
    Route::post('share','HomeController@shareAccount');
    Route::post('share/finalize','HomeController@shareFinalize');
    Route::post('getContent','HomeController@getPassword');
});

Route::get('securenotes','HomeController@notes');
Route::group(['prefix'=>'securenote','as'=>'securenote'], function(){
    Route::post('detail','HomeController@getNote');
    Route::post('add','HomeController@addNote');
    Route::post('edit','HomeController@editNote');
    Route::post('delete','HomeController@delNote');
    Route::post('share','HomeController@shareNote');
    Route::post('share/finalize','HomeController@shareFinalize');
    Route::post('getContent','HomeController@getNoteContent');
});

Route::get('drive','HomeController@drive');
Route::group(['prefix'=>'drive','as'=>'drive'], function(){
    Route::post('add','HomeController@addFile');
    Route::post('delete','HomeController@delFile');
    Route::post('download','HomeController@downloadFile');
});


Route::get('dashboard','HomeController@dashboard');

Route::get('sharewithme','HomeController@sharewithme');
Route::post('sharewithme/move','HomeController@moveAsset');
Route::post('sharewithme/delete','HomeController@deleteAsset');
Route::post('sharewithme/moveAccounts','HomeController@moveAccounts');
Route::post('sharewithme/moveNotes','HomeController@moveNotes');


Route::get('profile','HomeController@profile');
Route::post('profile/save','HomeController@saveProfile');
Route::post('profile/avatar','HomeController@updateAvatar');

Route::get('credential','HomeController@profile');
Route::post('credential/sync','HomeController@addPrivKey');
Route::post('credential/unsync','HomeController@delPrivKey');
Route::get('settings','HomeController@profile');
// Route::get('recovery','Recovery@profile');

Route::get('groups','GroupController@groups');
Route::group(['prefix' => 'group', 'as' => 'group'], function(){
    Route::post('checkUser','GroupController@checkUser');
    Route::post('addGroup','GroupController@addGroup');
    Route::post('addPGP','GroupController@addPGP');
    Route::post('editGroup','GroupController@editGroup');
    Route::post('delete','GroupController@deleteGroup');
    Route::post('deleteUser', 'GroupController@deleteUser');
    Route::post('changeRole','GroupController@changeRole');
    Route::get('{group_id}','GroupController@groupDetail');
    Route::group(['prefix' => 'account', 'as' => 'account'], function(){
        Route::post('detail','GroupController@getAccount');
        Route::post('add','GroupController@addAccount');
        Route::post('edit','GroupController@editAccount');
        Route::post('delete','GroupController@deleteAccount');
        // Route::post('share','GroupController@shareAccount');
        // Route::post('share/finalize','GroupController@shareFinalize');
        Route::post('getContent','GroupController@getPassword');
    });
    Route::group(['prefix'=>'securenote','as'=>'securenote'], function(){
        Route::post('detail','GroupController@getNote');
        Route::post('add','GroupController@addNote');
        Route::post('edit','GroupController@editNote');
        Route::post('delete','GroupController@delNote');
        // Route::post('share','GroupController@shareNote');
        // Route::post('share/finalize','GroupController@shareFinalize');
        Route::post('getContent','GroupController@getNoteContent');
    });
});

Route::get('quicksearch','HomeController@quickSearch');
Route::post('history','HomeController@history');

Route::get('test_gpg', function () {
    echo '<pre>';

    // Outputs all the result of shellcommand "ls", and returns
    // the last output line into $last_line. Stores the return value
    // of the shell command in $retval.
    $last_line = system('gpg --gen-key', $retval);

    // Printing additional info
    echo '
    </pre>
    <hr />Last line of the output: ' . $last_line . '
    <hr />Return value: ' . $retval;

});

// Route::get('userManage','HomeController@getUser');
// Route::group(['prefix' => 'userManage', 'as' => 'userManage'], function(){
//     Route::post('editUser','HomeController@editUser');
// });

Route::group(['prefix' => 'admin', 'as' => 'admin'], function(){
    Route::get('userManage','HomeController@getUser');
    Route::post('editUser','HomeController@editUser');
    Route::get('groupManage','HomeController@getGroup');
});
Route::get('email','HomeController@sendMail');

Route::get('pgp','HomeController@pgp');

Route::get('session-timeout/keepalive', 'HomeController@keepalive');

Route::get('setup', function () {
    App\Role::create(
        [
            'id' => '5bdf5220-d75c-11e8-843b-a7f6cbee423d',
            'name' => 'root',
            'description' => 'Super User for who the BOSS here.',
        ]);
    App\Role::create(
        [
            'id' => '5bed2760-d75c-11e8-8098-a930bf45516a',
            'name' => 'admin',
            'description' => 'Admin who under root',
        ]);
    App\Role::create(
        [
            'id' => '5bf9dea0-d75c-11e8-965c-95bc72799a6b',
            'name' => 'user',
            'description' => 'Normal user',
        ]);

    App\User::create(
        [
            'name' => 'root',
            'email' => 'master@secpass.com',
            'password' => bcrypt('password'),
            'active' => 1,
            'role_id' => '5bdf5220-d75c-11e8-843b-a7f6cbee423d',
        ]);
        
    return 'Roles created. Good to go !!';

});
