<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Accounts;
use App\User;
use Hash;

class HomeController extends Controller
{
    public function getLogin() {
    	return view('login');
    }
    public function postLogin(Request $req)
    {
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'password.required'=>'Vui lòng nhập password',
                'password.min'=>'Password ít nhất phải 6 kí tự',
                'password.max'=>'Password không quá 20 kí tự',
            ]);
            $credentials = array('email'=>$req->email,'password'=>$req->password);
            if(Auth::attempt($credentials))
            {
                return redirect('dashboard')->with(['flag'=>'success', 'thongbao'=>'Đăng nhập thành công!!!']);
            }
            else
            {
                return redirect()->back()->with(['flag'=>'danger', 'thongbao'=>'Đăng nhập không thành công!']);
            }
    }
    public function getSignup() {
    	return view('signup');
    }
    
    public function postSignup(Request $req)
    {
        $this->validate($req,
        [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'fullname'=>'required',
            're_password'=>'required|same:password'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'email.unique'=>'Email đã có người sử dụng',
            'password.required'=>'Vui lòng nhập password',
            'password.min'=>'Password ít nhất phải 6 kí tự',
            'password.max'=>'Password không quá 20 kí tự',
            'fullname.required'=>'Vui lòng nhập fullname',
            're_password.same'=>'Password không giống nhau'
        ]);
        $user = new User();
        $user->name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect('login');
    }

    public function forgetPassword() {
    	return view('forgetpassword');
    }
    public function getLogout(){
        Auth::logout();
        return redirect('login');
    }

    public function dashboard()
    {
        return view('page.dashboard');
    }
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


    public function accounts()
    {
        $accounts = Accounts::all();
        return view('page.accounts', compact('accounts'));
        // $accounts = Accounts::paginate(10);
        // $temp = Accounts::all();
        // // echo $accounts;
        // return view('page.accounts', compact('accounts','tempt'));
    }

    public function addAccount(Request $request)
    {
        // $this->validate($request,
        // [
        //     'url'=>'required',
        //     'name'=>'required',
        //     'username'=>'required',
        //     'password'=>'required|min:6|max:20'
        // ],
        // [
        //     'url.required'=>'Vui lòng nhập url',
        //     'name.required'=>'Vui lòng nhập name',
        //     'username.required'=>'Vui lòng nhập username',
        //     'password.required'=>'Vui lòng nhập password',
        //     'password.min'=>'Password ít nhất phải có 6 kí tự',
        //     'password.max'=>'Password tối đa 20 kí tự'

        // ]);

        $accounts = new Accounts;
        $accounts->name = $request->name;
        $accounts->username = $request->username;
        $accounts->uri = $request->url;
        $accounts->description = $request->description;
        $accounts->save();
        // return response()->json(['data'=> $accounts]);
        $accounts = Accounts::all();
        return response()->json(['success'=>'Got Simple Ajax Request.',
            'view'=> view('layouts.includes.content', compact('accounts'))->render()
            ]);
        //  return redirect()->back();//->with('thongbao','Thêm tài khoản thành công');

    }
    public function postEdit(Request $request){
        $idEdit = $request->idEdit;
        $acc = Accounts::find($idEdit);
        $acc->name = $request->nameEdit;
        $acc->username = $request->usernameEdit;
        $acc->uri = $request->urlEdit;
        $acc->description = $request->descriptionEdit;
        $acc->save();
        return redirect()->back()->with('thongbao','Chỉnh sửa tài khoản thành công');
    }
    public function deleteAccount(Request $request){
        // $id = $request->get('id');
        $idDelete = $request->idDelete;
        // $name = Accounts::find($idDelete)->name;
        $acc = Accounts::find($idDelete);
        $acc->delete();
        return redirect()->back()->with('thongbao','Xóa tài khoản thành công');
    }
    public function shareAccount(Request $request){
        $idShare = $request->idShare;
        $acc = Account::find($idShare);
        
    }
}
