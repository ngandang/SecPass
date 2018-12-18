<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

use App\Account;
use App\User;
use App\Note;
use App\Profile;
use App\PGPkey;
use App\Secret;
use App\Group;
use App\GroupUser;
use App\Share;

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
        $accounts = Auth::user()->account()->get();
        $notes = Auth::user()->note()->get();
        $groups = Auth::user()->group()->get();
        return view('page.dashboard', compact('accounts', 'notes', 'groups'));
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
        // $notes = DB::table('notes')
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
            'message' => 'Thêm tài khoản thành công',
            'view' => view('content.content-accounts', compact('accounts'))->render()
        ]);
    }

    public function editAccount(Request $request){
        $account_id = $request->id;
        $acc = Account::find($account_id);
        $acc->name = $request->name;
        $acc->username = $request->username;
        $acc->uri = $request->url;
        $acc->description = $request->description;
        $acc->save();

        if ($request->cipher) {
            $secret = Secret::where('account_id', $account_id)->first();
            $secret->data = $request->cipher;
            $secret->save();
        }
        
        $accounts = Auth::user()->account()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa tài khoản thành công',
            'view' => view('content.content-accounts', compact('accounts'))->render()
        ]);
    }

    public function deleteAccount(Request $request){
        $account_id = $request->id;
        
        $acc = Account::find($account_id);
        $acc->delete();

        $secret = Secret::where('account_id', $account_id)->first();
        $secret->delete();

        $accounts = Auth::user()->account()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa tài khoản thành công',
            'view' => view('content.content-accounts', compact('accounts'))->render()
        ]);
    }
    
    public function shareAccount(Request $request){
        $user = User::where('email',$request->email)->first();
        $account_id = $request->id;
        $account = Account::find($account_id);
        $secret = Secret::where('account_id',$account->id)->first();
        // co thi tra ve publickey shared user
        if($user) {
            $newAccount = $account->replicate();
            $newAccount->save();

            $newSecret = $secret->replicate();
            $newSecret->user_id = $user->id;
            $newSecret->account_id = $newAccount->id;
            $newSecret->data = "";
            $newSecret->save();

            $share = new Share;
            $share->asset_id = $newAccount->id;
            $share->user_id = $user->id;
            $share->owner_id = Auth::user()->id;
            $share->comment = $request->comment;
            $share->save();

            $sharedkey = PGPkey::where('user_id',$user->id)
                                ->where('type','6')
                                ->first();
            
            return response()->json([
                'success' => true,
                'message' => 'Truy xuất khoá người nhận thành công', // Người dùng tồn tại
                'sharedkey' => $sharedkey->armored_key,
                'id' => $newSecret->id,
                'content' => $secret->data
            ]);
        }
        else {
            // khong co thi gui mail marketing
            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Người dùng không tồn tại'
            ]);
        }
    }
        
    public function shareNote(Request $request){
        $user = User::where('email',$request->email)->first();
        $note_id = $request->id;
        $note = Note::find($note_id);
        $secret = Secret::where('note_id',$note->id)->first();
        // co thi tra ve publickey shared user
        if($user) {
            $newnote = $note->replicate();
            $newnote->save();

            $newSecret = $secret->replicate();
            $newSecret->user_id = $user->id;
            $newSecret->note_id = $newnote->id;
            $newSecret->data = "";
            $newSecret->save();

            $share = new Share;
            $share->asset_id = $newnote->id;
            $share->user_id = $user->id;
            $share->owner_id = Auth::user()->id;
            $share->comment = $request->comment;
            $share->save();

            $sharedkey = PGPkey::where('user_id',$user->id)
                                ->where('type','6')
                                ->first();
            
            return response()->json([
                'success' => true,
                'message' => 'Truy xuất khoá người nhận thành công', // Người dùng tồn tại
                'sharedkey' => $sharedkey->armored_key,
                'id' => $newSecret->id,
                'content' => $secret->data
            ]);
        }
        else {
            // khong co thi gui mail marketing
            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Người dùng không tồn tại'
            ]);
        }
    }

    public function shareFinalize(Request $request){
        $secret = Secret::find($request->id);
        $secret->data = $request->content;
        $secret->save();
        
        return response()->json([
            'success' => true,
            'message' => "Chia sẻ thành công"
        ]);
    }

    public function getPassword(Request $request)
    {
        $account_id = $request->id;
        $secret = Secret::where('account_id', $account_id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Đã sao chép mật khẩu',
            'content' => $secret->data
        ]);
    }

    public function notes()
    {
        $notes = Auth::user()->note()->get();

        return view('page.notes',compact('notes'));
    }

    public function getNoteContent(Request $request)
    {
        $note_id = $request->id;
        $secret = Secret::where('note_id', $note_id)->first();

        return response()->json([
            'success' => true,
            'message' => 'Đã sao chép nội dung',
            'content' => $secret->data
        ]);
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
        $secret->data = $req->cipher;
        $secret->save();

        $notes = Auth::user()->note()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Thêm ghi chú bảo mật thành công',
            'view' => view('content.content-notes', compact('notes'))->render()
        ]);
    }

    public function editNote( Request $request)
    {
        $note_id = $request->id;
        $note = Note::find($note_id);
        $note->title = $request->title;
        $note->save();

        if ($request->cipher) {
            $secret = Secret::where('note_id', $note_id)->first();
            $secret->data = $request->cipher;
            $secret->save();
        }

        $notes = Auth::user()->note()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa ghi chú bảo mật thành công',
            'view' => view('content.content-notes', compact('notes'))->render()
        ]);
    }

    public function delNote(Request $req){
        $note_id = $req->id;
        $note = Note::find($note_id);
        $note->delete();

        $secret = Secret::where('note_id', $note_id)->first();
        $secret->delete();

        $notes = Auth::user()->note()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa ghi chú bảo mật thành công',
            'view' => view('content.content-notes', compact('notes'))->render()
        ]);
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
            'message' => 'Thêm ghi chú bảo mật thành công',
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
            'message' => 'Xóa tài liệu thành công',
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
    
    public function sharewithme()
    {
        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');
        $accounts = Account::whereIn('id', $asset_ids)->get();
        $notes = Note::whereIn('id', $asset_ids)->get();

        return view('page.sharewithme', compact('assets','accounts','notes'));
    }


    public function groups()
    {
        $groups = Auth::user()->group()->get();
        return view('page.groups', compact('groups'));
    }
    public function groupDetail($group_id)
    {
        $group = Group::find($group_id);
        $groupUsers = DB::table('groups_users')
                ->where('group_id', $group_id)        
                ->join('users', 'groups_users.user_id', '=', 'users.id')
                ->select('groups_users.*','users.email','users.name')
                ->get();
        $admin = Auth::user()->GroupUser()->where('group_id',$group->id)->first()->is_admin;
        
        return view('page.groupdetail', compact('group','groupUsers','admin'));
    }
    public function checkUser(Request $request)
    {
        $email = $request->email;
        $user = User::where('email',$request->email)->first();
        if($user != null)
        {
            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Người dùng tồn tại'
            ]);
        }
        
        else{
            return response()->json([
                'success' => false,
                // TODO: lang this message
                'message' => 'Người dùng không tồn tại'
            ],500);
        }
    }
    public function addGroup(Request $request)
    {
        $user_admin = Auth::user();
        $group = new Group;
        $group->name = $request->name;
        $group->created_by = $user_admin->id;
        $group->modified_by = $user_admin->id;
        $group->save();

        $group_user = new GroupUser;
        $group_user->group_id = $group->id;
        $group_user->user_id = $user_admin->id;
        $group_user->is_admin = true;
        $group_user->save();
       
        $data = json_decode(stripslashes($_POST['li_variable']));

        foreach($data as $d){
            $user = User::where('email',$d)->first();
            $group_user = new GroupUser;
            $group_user->group_id = $group->id;
            $group_user->user_id = $user->id;
            $group_user->save();
        }
        
        // $users = User::where('email',$request->email)->get();
        // foreach ($list as $email)
        // {
        //     $user = User::where('email',$email)->first();

        //     $group_user = new GroupUser;
        //     $group_user->group_id = $group->id;
        //     $group_user->user_id = $user->id;
        //     $group_user->save();
        // }
        $groups = Auth::user()->group()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Tạo nhóm mới thành công',
            'view' => view('content.content-group', compact('groups'))->render()
        ]);
    }
    
    public function editGroup(Request $request)
    {
        $group_id = $request->id;
        $group = Group::find($group_id);
        $group->name = $request->name;
        $group->save();

        $groups_users = GroupUser::where('group_id', $group_id)->get();
        $user_id = $groups_users->pluck('user_id');
        $users = User::whereIn('id',$user_id)->get();;

        $emails = json_decode(stripslashes($_POST['li_variable']));

        foreach($emails as $email){
            $user = User::where('email', $email)->first();
            if(!($groups_users->where('user_id',$user->id)->first())) {
                $group_user = new GroupUser;
                $group_user->group_id = $group->id;
                $group_user->user_id = $user->id;
                $group_user->save();
            }
        }

        $groupUsers = DB::table('groups_users')
                ->where('group_id', $group_id)        
                ->join('users', 'groups_users.user_id', '=', 'users.id')
                ->select('groups_users.*','users.email','users.name')
                ->get();
        $admin = Auth::user()->GroupUser()->where('group_id',$group->id)->first()->is_admin;

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa nhóm thành công',
            'view' => view('content.content-group-user', compact('group','groupUsers','admin'))->render()
        ]);

    }

    public function deleteGroup(Request $request)
    {
        $group_id = $request->id;
        
        $group = Group::find($group_id);
        $group->delete();

        $group_user = GroupUser::where('group_id', $group_id)->first();
        $group_user->delete();

        $groups = Auth::user()->group()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa nhóm thành công',
            'view' => view('content.content-group', compact('groups'))->render()
        ]);
    }
    public function deleteUser(Request $request)
    {
        $user_id = $request->idDelete;
        $group_id = $request->idGroup;
        $group_user = GroupUser::where('group_id',$group_id)
                                ->where('user_id', $user_id)->first();
        $group_user->delete();

        $group = Group::find($group_id);
        $groupUsers = DB::table('groups_users')
                ->where('group_id', $group_id)        
                ->join('users', 'groups_users.user_id', '=', 'users.id')
                ->select('groups_users.*','users.email','users.name')
                ->get();
        $admin = Auth::user()->GroupUser()->where('group_id',$group->id)->first()->is_admin;

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa người dùng thành công',
            'view' => view('content.content-group-user', compact('group','groupUsers','admin'))->render()
        ]);

    }

    public function changeRole(Request $request)
    {
        $user_id = $request->idUser;
        $group_id = $request->idGroup;
        $group = GroupUser::where('group_id',$group_id)->get();
        $user = $group->where('user_id', $user_id)->first();
        
        if($request->role == 1) {
            $user->is_admin = 1;
        }
        else {
            if($request->role == 0) {
                if(count($group->where('is_admin',true)) == 1) {
                    return response()->json([
                        'success' => false,
                        // TODO: lang this message
                        'message' => 'Vui lòng chọn quản trị viên thay thế'
                    ],'500');
                }
                $user->is_admin = 0;
            }
        }
        // $group_user->group_id = $group->id;
        // $group_user->user_id = $user->id;
        $user->save();

        $group = Group::find($group_id);
        $groupUsers = DB::table('groups_users')
                ->where('group_id', $group_id)        
                ->join('users', 'groups_users.user_id', '=', 'users.id')
                ->select('groups_users.*','users.email','users.name')
                ->get();
        $admin = Auth::user()->GroupUser()->where('group_id',$group->id)->first()->is_admin;

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Thay đổi vai trò người dùng thành công',
            'view' => view('content.content-group-user', compact('group','groupUsers','admin'))->render()
        ]);
    }

    public function profile()
    { 
        $user = Auth::user();
        return view('page.profile', compact('user'));
    }

    public function addPrivKey(Request $request)
    { 
        try {            
            $user = Auth::user();
            // Only allow 2 keys in early development
            $pgp = PGPkey::where([
                ['user_id', $user->id],
                ['type', '5'],
            ]);
            $pgp->delete();

            $pgp_key = new PGPkey;
            $pgp_key->user_id = $user->id;
            $pgp_key->armored_key = $request->armored_key;
            $pgp_key->uid = $request->uid;
            $pgp_key->key_id = $request->key_id;

            $chars = array_map("chr", $request->fingerprint);
            $bin = join($chars);
            $hex = bin2hex($bin);
            $pgp_key->fingerprint = $hex;
            
            $pgp_key->type = $request->type; // '5' - private; '6' - public key packet

            if( $request->expires != "0" ) {
                $key_expires = substr( $request->key_expires, 0, strpos($request->key_expires, '(') );
                $pgp_key->expires = $key_expires;
            }

            $key_created = substr( $request->key_created, 0, strpos($request->key_created, '(') );
            $pgp_key->key_created = date('Y-m-d h:i:s', strtotime($key_created));
            
            $pgp_key->save();
        }
        catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Lưu khoá không thành công',
            ],500);
        }

        return response()->json([
            'success' => true,
            'message' => "Lưu khoá thành công",
        ]);
    }

    public function delPrivKey()
    {
        // Delete private key(s) as user requested
        $user = Auth::user();
        $pgp = PGPkey::where([
            ['user_id', $user->id],
            ['type', '5'],
        ]);
        $pgp->delete();

        return response()->json([
            'success' => true,
            'message' => "Huỷ khoá thành công",
        ]);
    }

    public function quickSearch(Request $request)
    { 
        // $user = Auth::user();
        // $result = DB::table('accounts')
        //     ->whereRaw(
        //         "MATCH (name, username) AGAINST (? IN NATURAL LANGUAGE MODE) LIMIT 10",
        //         array($request->q)
        //     )->get();

        $accounts = Account::search($request->q, null, true)->get();
        $notes = Note::search($request->q, null, true)->get();
        $groups = Group::search($request->q, null, true)->get();
        
        return view('content.quicksearch', compact('accounts','notes','groups'));
    } 

    public function pgp()
    {
        return view('page.pgp');
    }

    // public function addPGP()
    // {
    //     // TODO: receiving Info and publicKey from addon.
    //     $pgp_key = new PGPkey;
    //     $pgp_key->user_id = Auth::user()->id;
    //     $pgp_key->armored_key = "abc";
    //     $pgp_key->uid = "Nguyen Phi Cuong (cuong@secpass.com)";
    //     $pgp_key->key_id = "ABCDDBCA";
    //     $pgp_key->fingerprint = "ABCDDBCAABCDDBCAABCDDBCAABCDDBCA";
    //     $pgp_key->type = "what is this??";
    //     $pgp_key->expires = NOW();
    //     $pgp_key->key_created = NOW();
    //     $pgp_key->save();
        
    //     return $pgp_key;
    // }

    public function keepalive()
    {
        return response('',204);
    }

}
