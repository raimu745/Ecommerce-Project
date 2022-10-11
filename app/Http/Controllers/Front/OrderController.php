<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    function order_table(Request $request){
        // dd(324);

        $order = Order::Where('user_id', Auth::id())->get();

        return view('frontend.order_table',compact('order'));
    }

    function view_order($id){

        $order = Order::with('orderitems')->where('id',$id)->first();
        // dd($order);
        return view('frontend.view_order',compact('order'));
    }
}
