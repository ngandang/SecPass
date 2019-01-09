<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\GroupPGP;
use Illuminate\Support\Facades\Auth;
 
class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    public function index()
    {
        $user = Auth::user();
        $user->notify(new GroupPGP($post));
        
    }
}