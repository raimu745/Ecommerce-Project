<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    function order(){

        $order = Order::Where('status',0)->get();
        // dd($order);
        return view('pages.order',compact('order'));
    }
    function admin_order($id){
    //    dd($id);
        $order = Order::with('orderitems')->where('id',$id)->first();

        return view('pages.view_order',compact('order'));

    }
    function update_status(Request $request,$id){

         $order  = Order::find($id);
         $order->status = $request->status_order;
         $order->save();
         return redirect()->route("order");
    }
    function orderHistory(){
        //  dd(32);

        $order = Order::with('orderitems')->where('status',1)->first();
        // dd($order);
        return view('pages.order_history',compact('order'));
    }
}
