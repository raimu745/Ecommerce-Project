<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CvController extends Controller
{
    function index(){
        
        return view('admin.index');
        
    }

    function home(){

        return view('admin.pages.home');        
    }
    function register(){
        return view('auth.register');
    }
    function login(){
        return view('auth.login');
    }
    function noaccess(){
        return view('noaccess');
    }
}

