<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    function index(){
        $user = User::count();
        // dd($user);
        return view('pages.dashboard',compact('user'));
        // dd($user);
    }
    function countCat(){
        // dd(1322);
        $cat = Category::count();
        return view('pages.dashboard',compact('cat'));
    }
}
