<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Accounts;
use App\User;
use App\Notes;
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
            'view' => view('content.content-account', compact('accounts'))->render()
        ]);
    }

    public function editAccount(Request $request){
        $idEdit = $request->id;
        $acc = Accounts::find($idEdit);
        $acc->name = $request->name;
        $acc->username = $request->username;
        $acc->uri = $request->url;
        $acc->description = $request->description;
        $acc->save();
        
        $accounts = Accounts::all();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa tài khoản thành công.',
            'view' => view('content.content-account', compact('accounts'))->render()
        ]);
    }

    public function deleteAccount(Request $request){
        $idDelete = $request->idDelete;
        $acc = Accounts::find($idDelete);
        $acc->delete();
        $accounts = Accounts::all();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa tài khoản thành công.',
            'view' => view('content.content-account', compact('accounts'))->render()
        ]);
    }
    
    public function shareAccount(Request $request){
        $idShare = $request->idShare;
        $acc = Account::find($idShare);
        
    }
   
    public function securenotes()
    {
        $notes = Notes::all();
        return view('page.securenotes',compact('notes'));
    }
    public function addNote( Request $req)
    {
        $note = new Notes();
        $note->name = $req->name;
        $note->content = $req->note;
        $note->save();

        $notes = Notes::all();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Thêm tài khoản thành công.',
            'view' => view('content.content-note', compact('notes'))->render()
        ]);
    }

    public function editNote( Request $req)
    {
        $idEdit = $req->id;
        $note = Notes::find($idEdit);
        $note->name = $req->name;
        $note->content = $req->note;
        $note->save();

        $notes = Notes::all();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa tài khoản thành công.',
            'view' => view('content.content-note', compact('notes'))->render()
        ]);
    }
    public function delNote(Request $req){
        $idDel = $req->idDelete;
        $note = Notes::find($idDel);
        $note->delete();

        $notes = Notes::all();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa tài khoản thành công.',
            'view' => view('content.content-note', compact('notes'))->render()
        ]);
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
