<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     function index(){
        // dd(45);
        $user = User::all();
        // dd($user);
        return view('pages.user',compact('user'));
     }
     function viewUser($id){
        // dd(11);
        $user = User::find($id);
        return view('pages.view_user',compact('user'));
     }
}
