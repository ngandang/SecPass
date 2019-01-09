<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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
use App\AssetTracking;
use App\Message;


use Hash;
use Image;

use App\Mail\PotentialUser;

\Carbon\Carbon::setLocale('vi');

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
    // Tham khảo lại sau này
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

    public function getAccount(Request $request)
    {
        $account = Account::where("id", $request->id)->first();

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $account->id;
        $log->type = "get";
        $log->save();
        
        return $account;
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
        $secret->owner_id = $user->id;
        $secret->asset_id = $account->id;
        // TODO: encrypt OpenGPG
        $secret->data = $request->cipher;
        $secret->save();
        
        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $account->id;
        $log->type = "add";
        $log->save();

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
        $account = Account::find($account_id);
        $account->name = $request->name;
        $account->username = $request->username;
        $account->uri = $request->url;
        $account->description = $request->description;
        $account->save();

        if ($request->cipher) {
            $secret = Secret::where('asset_id', $account_id)->first();
            $secret->data = $request->cipher;
            $secret->save();
        }
        
        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $account->id;
        $log->type = "edit";
        $log->save();
        
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
        
        $account = Account::find($account_id);
        $account->delete();

        $secret = Secret::where('asset_id', $account_id)->first();
        $secret->delete();

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $account_id;
        $log->type = "delete";
        $log->save();

        $accounts = Auth::user()->account()->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xóa tài khoản thành công',
            'view' => view('content.content-accounts', compact('accounts'))->render()
        ]);
    }
    
    public function shareAccount(Request $request){
        $user = User::where('email', $request->email)->first();
        $account_id = $request->id;
        $account = Account::find($account_id);
        $secret = Secret::where('asset_id',$account->id)->first();
        // co thi tra ve publickey shared user
        if($user) {
            $newAccount = $account->replicate();
            $newAccount->save();

            $newSecret = $secret->replicate();
            $newSecret->owner_id = $user->id;
            $newSecret->asset_id = $newAccount->id;
            $newSecret->data = "";
            $newSecret->save();

            $share = new Share;
            $share->asset_id = $newAccount->id;
            $share->user_id = $user->id;
            $share->shared_by = Auth::user()->id;
            $share->comment = $request->comment;
            $share->save();

            $sharedkey = PGPkey::where('owner_id', $user->id)
                                ->where('type','6')
                                ->first();
            
            // Asset tracking
            $log = new AssetTracking;
            $log->user_id = Auth::user()->id;
            $log->asset_id = $account_id;
            $log->type = "share";
            $log->save();

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
            Mail::to($request->email)->send(new PotentialUser(Auth::user(), $account, "account"));

            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Người nhận chưa đăng ký dịch vụ',
                'detail' => 'Email thông báo đã được gửi tới người nhận, bạn vẫn cần gửi lại thông tin sau khi người dùng đăng ký dịch vụ thành công.'
            ],500);
        }
    }
        
    public function shareNote(Request $request){
        $user = User::where('email', $request->email)->first();
        $note_id = $request->id;
        $note = Note::find($note_id);
        $secret = Secret::where('asset_id', $note->id)->first();
        // co thi tra ve publickey shared user
        if($user) {
            $newnote = $note->replicate();
            $newnote->save();

            $newSecret = $secret->replicate();
            $newSecret->owner_id = $user->id;
            $newSecret->asset_id = $newnote->id;
            $newSecret->data = "";
            $newSecret->save();

            $share = new Share;
            $share->asset_id = $newnote->id;
            $share->user_id = $user->id;
            $share->shared_by = Auth::user()->id;
            $share->comment = $request->comment;
            $share->save();

            $sharedkey = PGPkey::where('owner_id',$user->id)
                                ->where('type','6')
                                ->first();
            
            // Asset tracking
            $log = new AssetTracking;
            $log->user_id = Auth::user()->id;
            $log->asset_id = $note_id;
            $log->type = "share";
            $log->save();
            
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
            Mail::to($request->email)->send(new PotentialUser(Auth::user(), $note, "note"));

            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Người nhận chưa đăng ký dịch vụ',
                'detail' => 'Email thông báo đã được gửi tới người nhận, bạn vẫn cần gửi lại thông tin sau khi người dùng đăng ký dịch vụ thành công.'
            ],500);
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
        $secret = Secret::where('asset_id', $account_id)->first();

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $account_id;
        $log->type = "get";
        $log->save();
        
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

    public function getNote(Request $request)
    {
        $note = Note::where("id", $request->id)->first();

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $note->id;
        $log->type = "get";
        $log->save();

        return $note;
    }

    public function getNoteContent(Request $request)
    {
        $note_id = $request->id;
        $secret = Secret::where('asset_id', $note_id)->first();

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $note_id;
        $log->type = "get";
        $log->save();

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
        $secret->owner_id = $user->id;
        $secret->asset_id = $note->id;
        // TODO: encrypt OpenGPG
        $secret->data = $req->cipher;
        $secret->save();

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $note->id;
        $log->type = "add";
        $log->save();

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
            $secret = Secret::where('asset_id', $note_id)->first();
            $secret->data = $request->cipher;
            $secret->save();
        }

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $note_id;
        $log->type = "edit";
        $log->save();

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

        $secret = Secret::where('asset_id', $note_id)->first();
        $secret->delete();

        // Asset tracking
        $log = new AssetTracking;
        $log->user_id = Auth::user()->id;
        $log->asset_id = $note_id;
        $log->type = "delete";
        $log->save();

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
            'message' => 'Thêm tài liệu thành công',
            'view' => view('content.content-drive', compact('files'))->render()
        ]);
    }

    public function shareFile(Request $request)
    {
        $receiver = User::where('email', $request->email)->first();
        if($receiver)
        {
            $filename  = $request->filename;
            Storage::disk('userstorage')->copy(Auth::user()->id.'/'.$filename, $receiver->id.'/'.$filename);
           
            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Chia sẻ tài liệu thành công'
            ]);
        }
        return response()->json([
            'success' => false,
            // TODO: lang this message
            'message' => 'Không tìm thấy người dùng'
        ], 500);
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
    
    public function sharewithme()
    {
        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');
        $accounts = Account::whereIn('id', $asset_ids)->get();
        $notes = Note::whereIn('id', $asset_ids)->get();

        return view('page.sharewithme', compact('accounts','notes'));
    }

    public function deleteAsset(Request $request)
    {
        $asset = Share::find($request->id);

        Secret::where('asset_id', $asset->id)->delete();
        Account::where('id', $asset->id)->delete();
        Note::where('id', $asset->id)->delete();
        $asset->delete();

        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');
        $accounts = Account::whereIn('id', $asset_ids)->get();
        $notes = Note::whereIn('id', $asset_ids)->get();

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Xoá thành công',
            'view' => view('content.content-sharewithme', compact('accounts','notes'))->render()
        ]);
    }

    public function moveAsset(Request $request)
    {
        $asset_id = $request->id;
        Share::where('asset_id', $asset_id)->delete();

        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');
        $accounts = Account::whereIn('id', $asset_ids)->get();
        $notes = Note::whereIn('id', $asset_ids)->get();

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Đã chuyển thành công',
            'view' => view('content.content-sharewithme', compact('accounts','notes'))->render()
        ]);
    }

    public function moveAccounts(Request $request)
    {
        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');

        $accounts = Account::whereIn('id', $asset_ids)->get();
        $account_ids = $accounts->pluck('id');
        Share::whereIn('asset_id', $account_ids)->delete();

        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');
        $accounts = Account::whereIn('id', $asset_ids)->get();
        $notes = Note::whereIn('id', $asset_ids)->get();

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Đã chuyển thành công',
            'view' => view('content.content-sharewithme', compact('accounts','notes'))->render()
        ]);        
    }
    
    public function moveNotes(Request $request)
    {
        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');

        $notes = Note::whereIn('id', $asset_ids)->get();
        $note_ids = $notes->pluck('id');
        Share::whereIn('asset_id', $note_ids)->delete();

        $assets = Auth::user()->share()->get();
        $asset_ids = $assets->pluck('asset_id');
        $accounts = Account::whereIn('id', $asset_ids)->get();
        $notes = Note::whereIn('id', $asset_ids)->get();


        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Đã chuyển thành công',
            'view' => view('content.content-sharewithme', compact('accounts','notes'))->render()
        ]);
    }

    public function profile()
    { 
        $user = Auth::user();
        $profile = $user->profile()->first();
        $profile->date_of_birth = \Carbon\Carbon::parse($profile->date_of_birth)->toDateString();
        return view('page.profile', compact('user', 'profile'));
    }
    public function updateAvatar(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' .$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(130,130)->save( public_path('storage/avatars/' . $filename) );
            $user = Auth::user();
            $profile = $user->profile()->first();
            $profile->avatar = $filename;
            $profile->save();

            // return view('page.profile', compact('user', 'profile'));
            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Lưu thay đổi thành công',
                'view' => view('page.profile', compact('user', 'profile'))
            ]);
        }
        else
        {
            return response()->json([
                'success' => true,
                // TODO: lang this message
                'message' => 'Vui lòng chọn ảnh'
            ], 500);
        }
    }
    public function saveProfile(Request $request)
    { 
        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        $profile = $user->profile()->first();
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->gender = $request->gender;
        $profile->date_of_birth = $request->date_of_birth;
        $profile->phone = $request->phone;
        $profile->address = $request->address;
        // $profile->timezone = $request->timezone;
        // $profile->language = $request->language;
        $profile->save();

        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Lưu thay đổi thành công'
        ]);
    }

    public function getPGP(Request $request)
    {
        if ($request->email)
            $user = User::where('email', $request->email)->first();
        $pgp = PGPkey::where('owner_id', $user->id)->first();

        return $pgp;
    }

    public function addPrivKey(Request $request)
    { 
        try {            
            $user = Auth::user();
            // Only allow 2 keys in early development
            $pgp = PGPkey::where([
                ['owner_id', $user->id],
                ['type', '5'],
            ]);
            $pgp->delete();

            $pgp_key = new PGPkey;
            $pgp_key->owner_id = $user->id;
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
            ['owner_id', $user->id],
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
        $accounts = Auth::user()->account()->search($request->q, null, true)->get();
        $notes = Auth::user()->note()->search($request->q, null, true)->get();
        $groups = Auth::user()->group()->search($request->q, null, true)->get();
        
        return view('content.quicksearch', compact('accounts','notes','groups'));
    } 

    public function history()
    {
        $user = Auth::user();
        $logs = $user->track()->where("type","get")->get();
        $log_ids = $logs->pluck("asset_id");
        $accounts = Account::whereIn('id', $log_ids)->get();

        return response()->json([
            'success' => true,
            'view' => view('content.history', compact('accounts'))->render()
        ]);
    }

    public function admin()
    {
        $users = User::where('role_id','!=','5bdf5220-d75c-11e8-843b-a7f6cbee423d')->get();
        $groups = Group::all();
        return view('admin.admin', compact('users','groups'));
    }
    public function editUser(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->status;
        $user->role_id = $request->role;

        $user->save();

        $users = User::where('role_id','!=','5bdf5220-d75c-11e8-843b-a7f6cbee423d')->get();
        return response()->json([
            'success' => true,
            // TODO: lang this message
            'message' => 'Chỉnh sửa người dùng thành công',
            'view' => view('admin.content-user-manage', compact('users'))->render()
        ]);
    }
    
    public function getUnreadNotifications()
    {
        return response()->json([
            'success' => true,
            'view' => view('content.notifications')->render()
        ]);
    }
    
    public function maskAsRead(Request $request){
        Auth::user()->notifications->find($request->id)->markAsRead();
        return response()->json([
            'success' => true,
            'message' => 'Đánh dấu đã đọc thành công',
            'view' => view('content.notifications')->render()
        ]);
    }

    public function maskAllAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json([
            'success' => true,
            'message' => 'Đánh dấu tất cả đã đọc thành công',
            'view' => view('content.notifications')->render()
        ]);
    }

    // public function pgp()
    // {
    //     return view('page.pgp');
    // }

    public function keepalive()
    {
        return response('',204);
    }

}
