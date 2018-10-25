<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'dashboard';

    protected function authenticated(Request $request, $user) {
        if($request->ajax()) {
            if(!$user->active) {
                auth()->logout();
             
                if($user->created_by) {
                    return response()->json([ 'message' => 'Tài khoản của bạn hiện đang bị vô hiệu hoá. Vui lòng liên hệ quản trị viên.']);
                }
                
                return response()->json([ 'intended' => '/register/verify' ]);
            }
            
            return response()->json([ 'intended' => $this->redirectPath() ]);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
