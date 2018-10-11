<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Accounts;
use App\User;
use Hash;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('page.dashboard');
    }

    public function accounts()
    {
        $accounts = Accounts::all();
        return view('page.accounts', compact('accounts'));
    }

    public function addAccount(Request $request)
    {
        $account = new Accounts;
        $account->name = $request->name;
        $account->uri = $request->url;
        $account->username = $request->username;
        $account->description = $request->description;
        $account->save();

        //TODO: nối id tới secret ứng mỗi user khác nhau
        // $secret = new Secrets;
        // $user = user();
        // $secret->user_id()->save($user);
        // $secret->account_id()->save($account);
        // $secret->data = bcrypt($request->password);
        $accounts = Accounts::all();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Thêm tài khoản thành công.',
            'view' => view('accounts.index', compact('accounts'))->render()
        ]);
    }

    public function editAccount(Request $request){
        $idEdit = $request->idEdit;
        $acc = Accounts::find($idEdit);
        $acc->name = $request->nameEdit;
        $acc->username = $request->usernameEdit;
        $acc->uri = $request->urlEdit;
        $acc->description = $request->descriptionEdit;
        $acc->save();
        return redirect()->back();
    }

    public function deleteAccount(Request $request){
        $idDelete = $request->idDelete;
        $acc = Accounts::find($idDelete);
        $acc->delete();
        return redirect()->back();
    }
    
    public function shareAccount(Request $request){
        $idShare = $request->idShare;
        $acc = Account::find($idShare);
        
    }

    // Ngân: Login tự viết
    // public function getLogin() {
    // 	return view('login');
    // }
    // public function postLogin(Request $req)
    // {
    //     $this->validate($req,
    //         [
    //             'email'=>'required|email',
    //             'password'=>'required|min:6|max:20'
    //         ],
    //         [
    //             'email.required'=>'Vui lòng nhập email',
    //             'email.email'=>'Không đúng định dạng email',
    //             'password.required'=>'Vui lòng nhập password',
    //             'password.min'=>'Password ít nhất phải 6 kí tự',
    //             'password.max'=>'Password không quá 20 kí tự',
    //         ]);
    //         $credentials = array('email'=>$req->email,'password'=>$req->password);
    //         if(Auth::attempt($credentials))
    //         {
    //             return redirect('dashboard')->with(['flag'=>'success', 'thongbao'=>'Đăng nhập thành công!!!']);
    //         }
    //         else
    //         {
    //             return redirect()->back()->with(['flag'=>'danger', 'thongbao'=>'Đăng nhập không thành công!']);
    //         }
    // }
    // public function getSignup() {
    // 	return view('signup');
    // }
    
    // public function postSignup(Request $req)
    // {
    //     $this->validate($req,
    //     [
    //         'email'=>'required|email|unique:users,email',
    //         'password'=>'required|min:6|max:20',
    //         'fullname'=>'required',
    //         're_password'=>'required|same:password'
    //     ],
    //     [
    //         'email.required'=>'Vui lòng nhập email',
    //         'email.email'=>'Không đúng định dạng email',
    //         'email.unique'=>'Email đã có người sử dụng',
    //         'password.required'=>'Vui lòng nhập password',
    //         'password.min'=>'Password ít nhất phải 6 kí tự',
    //         'password.max'=>'Password không quá 20 kí tự',
    //         'fullname.required'=>'Vui lòng nhập fullname',
    //         're_password.same'=>'Password không giống nhau'
    //     ]);
    //     $user = new User();
    //     $user->name = $req->fullname;
    //     $user->email = $req->email;
    //     $user->password = Hash::make($req->password);
    //     $user->save();
    //     return redirect('login');
    // }

    // public function forgetPassword() {
    // 	return view('forgetpassword');
    // }
    // public function getLogout(){
    //     Auth::logout();
    //     return redirect('login');
    // }

    // public function dashboard()
    // {
    //     return view('page.dashboard');
    // }
    // public function accounts()
    // {
    //     return view('page.accounts'); 
    // }
    public function drive()
    {
        return view('page.drive');
    }
    public function credential()
    {
        return view('page.credential');
    }
    public function securenotes()
    {
        return view('page.securenotes');
    }
    public function settings()
    {
        return view('page.settings');
    }
    public function sharewith()
    {
        return view('page.sharewith');
    }
    public function groups()
    {
        return view('page.groups');
    }

}
