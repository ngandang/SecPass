<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Accounts;

class AccountsController extends Controller
{
    public function index()
    {

        return view('page.accounts');
    }

    public function postCreate()
    {
        $accounts = new Accounts;
        $accounts->url = request('url');
        $accounts->username = request('username');
        // store password
        $accounts->description = request('description');
        $accounts->save();
        //$info = 'success';
        //return redirect()->back()->with('info', 'success');
        return response()->json(['success'=>'Data is successfully added']);
    }
}
