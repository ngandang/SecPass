<?php

namespace App\Http\Controllers\Auth;

use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Users
     */
    protected function create(array $data)
    {
        $user = Users::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'verification_code' => time().uniqid(true),
        ]);

        //do your role stuffs here

        //send verification mail to user
        //---------------------------------------------------------
        // $data['verification_code']  = $user->verification_code;

        // Mail::send('emails.verify', $data, function($message) use ($data)
        // {
        //     //TODO: change this for production
        //     $message->from('no-reply@secpass.com', "SecPass");
        //     $message->subject("Welcome to SecPass");
        //     $message->to($data['email']);
        // });


        return $user;
    }

    public function verify($code)
    {
        $user = Users::where('verification_code', $code);

        if ($user->count() > 0) {
            $user->update([
                'active' => true,
                'verification_code' => null
            ]);
            $notification_status = 'Xác nhận tài khoản thành công.';
        } else {
            $notification_status ='Mã xác nhận không chính xác hoặc đã quá hạn.';
        }

        return redirect(route('login'))->with('status', 'success')->with(
            'message', $notification_status
        );
    }
}
