<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Whishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class WhislistController extends Controller
{
    function index(){

        $wish = Whishlist::with('products')->Where('user_id',Auth::id())->get();
        // dd($wish);

        return view('frontend.wishlist',compact('wish'));
    }

    function add_wish(Request $request){

        if(Auth::check()){
            $id = $request->id;
            if(Product::find($id)){

                $wish = new Whishlist();
                $wish->prod_id = $id;
                $wish->user_id = Auth::id();
                $wish->save();

            return response()->json(['msg'=> 'products add in wishlist']);

            }
            return response()->json(['msg'=> 'you are logged in ']);
        }else{
            return response()->json(['msg'=> 'please login first']);
        }

    }

    function wish_delete(Request $request){

        $id = $request->id;
        $wish = Whishlist::find($id);
        $wish->delete();

        if($wish)
        {
            return response()->json(['msg'=> 'suucess']);

        }else{
            return response()->json(['msg'=> 'error']);
        }


    }
    function wish_count(){

        $wish = Whishlist::where('user_id',Auth::id())->count();
        // dd($wish);
      Session::put('cart_value', $wish);
      
    //   dd(session()->all());
        // return response()->json(['msg'=> $wish]);

    }
}
