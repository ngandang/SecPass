<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Group;

class AdminController extends Controller
{
    public function __construct()
    {        
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function admin()
    {
        return redirect("admin");
        // return "Yes, you are an administrator.";
        // return view('admin');
    }

    
    public function getUsers()
    {
        $users = User::where('role_id','!=','5bdf5220-d75c-11e8-843b-a7f6cbee423d')->get();
        return view('admin.user-manage', compact('users'));
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

    public function getGroups()
    {
        $groups = Group::all();
        return view('admin.group-manage', compact('groups'));
    }
}
