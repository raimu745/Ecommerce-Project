<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   function register_store(Request $request){
        // dd(342);
        // dd($request->all());
        // $request->validate([

        //     'name' => 'required',
        //     'password'  =>  'required|min:6|confirmed',
        //     'confirm_password'  =>  'required|min:6|confirmed',
        //     'email' => 'required|email|unique:users'

        // ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect()->back();
   }

   function login_store(Request $request){
      //   dd(123);
      $mail = User::where('email',$request->email)->first();

      if($mail){
             $password = User::where('password',$request->password)->first();
             if($password ){

                  return redirect()->route('dashboard');
             }else{
               return redirect()->back()->with('pass',"incorrect password");
             }
      }else{
         return redirect()->back()->with('msg',"incorrect email");
      }

}

           public function logout(Request $request) {
            // dd(11);
             Auth::logout();
            return redirect('/login');
            }

}
