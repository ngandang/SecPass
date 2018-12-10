<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\User;
use App\Profile;
use App\PGPkey;

use App\Mail\VerifyUser;

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
            'password' => array(
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
                // Contain at least one uppercase/lowercase letters, one number and one special char
                )
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => '5bf9dea0-d75c-11e8-965c-95bc72799a6b',
            'verification_code' => time().uniqid(true),
        ]);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Đang khởi tạo cặp khoá PGP...',
            'user_id' => $user->id
        ]);
    }

    public function addPGP(Request $request)
    {
        try {
            // TODO: receiving Info and publicKey from addon.
            $pgp_key = new PGPkey;
            $pgp_key->user_id = $request->user_id;
            $pgp_key->armored_key = $request->armored_key;
            $pgp_key->uid = $request->uid;
            $pgp_key->key_id = $request->key_id;

            $chars = array_map("chr", $request->fingerprint);
            $bin = join($chars);
            $hex = bin2hex($bin);
            $pgp_key->fingerprint = $hex;
            
            $pgp_key->type = $request->type; // '6' - public key packet

            if( $request->expires != "0" ) {
                $key_expires = substr( $request->key_expires, 0, strpos($request->key_expires, '(') );
                $pgp_key->expires = $key_expires;
            }

            $key_created = substr( $request->key_created, 0, strpos($request->key_created, '(') );
            $pgp_key->key_created = date('Y-m-d h:i:s', strtotime($key_created));
            
            $pgp_key->save();

            $user = User::find($pgp_key->user_id);
            Mail::to($user)->send(new VerifyUser($user));
            
            Profile::create([
                'user_id' => $user->id,
            ]);
        }
        catch(\Exception $e) {
            $user = User::find($request->user_id);
            $user->delete();
            return response()->json([
                'success' => false,
                'message' => 'Đăng ký không thành công. Vui lòng thực hiện lại sau.',
            ],500);
        }

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Khởi tạo cặp khoá PGP thành công. Vui lòng kiểm tra hộp thư email của bạn.'
        ]);
    }

    public function sendmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user->count() > 0) {
            $user->update([
                'verification_code' => time().uniqid(true)
            ]);
            Mail::to($user)->send(new VerifyUser($user));

            return response()->json(['status' => 'success', 'message' => 'Gửi mã xác nhận thành công. Vui lòng kiểm tra hộp thư email của bạn.']);
        }

        return response()->json(['status' => 'danger', 'message' => 'Email được nhập không tồn tại. Vui lòng kiểm tra lại.']);
    }

    public function verify($code)
    {
        $user = User::where('verification_code', $code);

        if ($user->count() > 0) {
            $user->update([
                'active' => true,
                'verification_code' => null
            ]);

            return view('auth.verify')->with(['status' => true]);
        }
        
        return view('auth.verify')->with(['status' => false]);
    }

}
