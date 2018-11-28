<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Account;
use App\User;
use App\Note;
use App\Profile;
use App\PGPkey;
use App\Secret;
use Hash;
use App\Mail\SendMailable;


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
    // public function getUserAccounts()
    // {

    //     $accounts = DB::table('accounts')
    //         ->join('secrets', 'accounts.id', '=', 'secrets.account_id')
    //         ->where('secrets.user_id', '=', Auth::user()->id)
    //         ->select('accounts.*','secrets.data')
    //         ->get();
        
    //     return $accounts;
    // }
    // public function getUserNotes()
    // {
    //     // $notes = DB::table('notes')
    //     //     ->join('secrets', 'notes.id', '=', 'secrets.note_id')
    //     //     ->where('secrets.user_id', '=', Auth::user()->id)
    //     //     ->select('notes.*')
    //     //     ->get();
    //     $notes = Auth::user()->note()->get();
        
    //     return $notes;
    // }
    public function accounts()
    {
        $accounts = Auth::user()->account()->get();
            
        return view('page.accounts', compact('accounts'));
    }

    public function addAccount(Request $request)
    {
        $account = new Account;
        $account->name = $request->name;
        $account->uri = $request->url;
        $account->username = $request->username;
        $account->description = $request->description;
        $account->save();

        // Nối id tới secret ứng mỗi user khác nhau
        $secret = new Secret;
        $user = Auth::user();
        $secret->user_id = $user->id;
        $secret->account_id = $account->id;
        // TODO: encrypt OpenGPG
        $secret->data = $request->cipher;
        $secret->save();
        
        $accounts = Auth::user()->account()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Thêm tài khoản thành công.',
            'view' => view('content.content-accounts', compact('accounts'))->render()
        ]);
    }

    public function editAccount(Request $request){
        $idEdit = $request->id;
        $acc = Account::find($idEdit);
        $acc->name = $request->name;
        $acc->username = $request->username;
        $acc->uri = $request->url;
        if ($request->password)
            $acc->password = $request->password;
        $acc->description = $request->description;
        $acc->save();
        
        $accounts = Auth::user()->account()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa tài khoản thành công.',
            'view' => view('content.content-accounts', compact('accounts'))->render()
        ]);
    }

    public function deleteAccount(Request $request){
        $idDelete = $request->idDelete;
        $acc = Account::find($idDelete);
        $acc->delete();

        $accounts = Auth::user()->account()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa tài khoản thành công.',
            'view' => view('content.content-accounts', compact('accounts'))->render()
        ]);
    }
    
    public function shareAccount(Request $request){
        $idShare = $request->idShare;
        $acc = Account::find($idShare);
        //TODO: share account
    }
    public function copyPassword(Request $request)
    {
        $account_id = $request->id;
        $secret = Secret::where('account_id', $account_id)->first();
        // TODO: decrypt OpenPGP
        return response()->json([
            'success' => true,
            'message' => 'Đã sao chép mật khẩu',
            'password' => $secret->data
        ]);
    }
    public function notes()
    {
        $notes = Auth::user()->note()->get();

        return view('page.notes',compact('notes'));
    }

    public function addNote( Request $req)
    {
        $note = new Note();
        $note->title = $req->title;
        $note->save();

        // Nối id tới secret ứng mỗi user khác nhau
        $secret = new Secret;
        $user = Auth::user();
        $secret->user_id = $user->id;
        $secret->note_id = $note->id;
        // TODO: encrypt OpenGPG
        $secret->data = $req->note;
        $secret->save();

        $notes = Auth::user()->note()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Thêm ghi chú bảo mật thành công.',
            'view' => view('content.content-notes', compact('notes'))->render()
        ]);
    }

    public function editNote( Request $req)
    {
        $idEdit = $req->id;
        $note = Note::find($idEdit);
        $note->title = $req->title;
        $note->content = $req->note;
        $note->save();

        $notes = Auth::user()->note()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa ghi chú bảo mật thành công.',
            'view' => view('content.content-notes', compact('notes'))->render()
        ]);
    }
    public function delNote(Request $req){
        $idDel = $req->id;
        $note = Note::find($idDel);
        $note->delete();

        $notes = Auth::user()->note()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa ghi chú bảo mật thành công.',
            'view' => view('content.content-notes', compact('notes'))->render()
        ]);
    }

    public function shareNote(Request $request){
        $idShare = $request->idShare;
        $acc = Account::find($idShare);
        //TODO: share note
    }

    public function drive()
    {
        $allFiles = Storage::disk('userstorage')->allFiles(Auth::user()->id);

        $files = array();

        foreach ($allFiles as $file) {

            $files[] = $this->fileInfo(pathinfo(storage_path('app/store/').$file));
        }
       
        return view('page.drive', compact('files'));
        
    }
    public function fileInfo($filePath)
    {
        $file = array();
        $file['name'] = $filePath['filename'];
        $file['extension'] = $filePath['extension'];
        $file['size'] = filesize($filePath['dirname'] . '/' . $filePath['basename']);
        $file['lastModified'] = date("d/m/Y", filemtime($filePath['dirname'] . '/' . $filePath['basename']));
        return $file;
    }
    
    public function addFile(Request $request)
    {
        $path = $request->file('fileToUpload')->storeAs(
            'store/'.Auth::user()->id, $request->file('fileToUpload')->getClientOriginalName()
        );

        $allFiles = Storage::disk('userstorage')->allFiles(Auth::user()->id);

        $files = array();

        foreach ($allFiles as $file) {

            $files[] = $this->fileInfo(pathinfo(storage_path('app/store/').$file));
        }
       
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Thêm ghi chú bảo mật thành công.',
            'view' => view('content.content-drive', compact('files'))->render()
        ]);
        // $path=$request->)->store('store');
        // echo $path;
    }
    public function delFile(Request $request)
    {
        $filename  = $request->filename;
        Storage::disk('userstorage')->delete(Auth::user()->id.'/'.$filename);

        $allFiles = Storage::disk('userstorage')->allFiles(Auth::user()->id);

        $files = array();

        foreach ($allFiles as $file) {

            $files[] = $this->fileInfo(pathinfo(storage_path('app/store/').$file));
        }
       
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa tài liệu thành công.',
            'view' => view('content.content-drive', compact('files'))->render()
        ]);
    }

    public function downloadFile(Request $request)
    {
        $filename  = $request->filename;
        return Storage::disk('userstorage')->download(Auth::user()->id.'/'.$filename);
    }

    public function sendMail()
    {
        $data = array('name'=>"Ngan", "body" => "Test mail");
    
        Mail::send('emails.sendmail', $data, function($message) {
            $message->to('dangthingan1996@gmail.com', 'Ngan Dang')
                    ->subject('Web Testing Mail');
            $message->from('ngandt52@gmail.com','SecPass');
        });
        return "Your email has been sent successfully";
    }

    // public function generate($pass){
    //     return Keygen::numeric(16)->generate();
    // }
    // public function generatePassword(Request $request){
        
    // }
    // public function generatePassword(){
    //     addForm.password.value = generatePassword(addForm.pass.value);
    // }

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
    
    public function credential()
    {
        return view('page.credential');
    }
    
    public function settings()
    {
        return view('page.settings', compact());
    }
    public function sharewith()
    {
        return view('page.sharewith');
    }
    public function groups()
    {
        return view('page.groups');
    }
    public function profile()
    { 
        $user = Auth::user();
        return view('page.profile', compact('user'));
    }

    public function quickSearch(Request $request)
    { 
        $user = Auth::user();
        return view('content.quicksearch', compact('user'));
    } 

    public function pgp()
    {
        return view('page.pgp');
    }

    public function addPGP()
    {
        // TODO: receiving Info and publicKey from addon.
        $pgp_key = new PGPkey;
        $pgp_key->user_id = Auth::user()->id;
        $pgp_key->armored_key = "abc";
        $pgp_key->uid = "Nguyen Phi Cuong (cuong@secpass.com)";
        $pgp_key->key_id = "ABCDDBCA";
        $pgp_key->fingerprint = "ABCDDBCAABCDDBCAABCDDBCAABCDDBCA";
        $pgp_key->type = "what is this??";
        $pgp_key->expires = NOW();
        $pgp_key->key_created = NOW();
        $pgp_key->save();
        
        return $pgp_key;
    }

    public function keepalive()
    {
        return response('',204);
    }

}
