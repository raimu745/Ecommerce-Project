<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Review;
use App\Models\User;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Stripe;
use PDF;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontController extends Controller
{
    function index(){
        return view('frontendlayout.master');
    }
    function prod_fetch(){
           $product = Product::where('trending','1')->take(4)->get();
           $category = Category::where('popular','1')->take(10)->get();
        //    dd($category);
        return view('frontend.product',compact('product','category'));
    }
    function categoryPro($slug){
        if(Category::where('slug',$slug)->exists()){
            $category = Category::where('slug',$slug)->first();
            // dd($category->id);
            //
            $products = Product::where('cate_id', $category->id)->get();
            // dd($products);
            return view('frontend.catProd',compact('category','products'));
        }
        else{
            return 'not exists';
        }
    }
    function productView($slug,$pslug){
        // dd(112);
        if(Category::where('slug',$slug)->exists()){
            if(Product::where('slug',$pslug)->exists()){
                // return 'prod exits';
                $product = Product::where('slug',$pslug)->first();
                $rating = Rating::where('prod_id',$product->id)->get();
                $rating_sum = Rating::where('prod_id',$product->id)->sum('prod_rat');
                 $review = Review::all();
                // $rat_val = $rating_sum / $rating->count();
                if($rating->count() > 0){
                   $rat_val = $rating_sum / $rating->count();
                }else{
                    echo 'logical error';
                }

                // dd($rat_val);
                // dd($product);

                return view('frontend.prod_view',compact('product','rating','rating_sum','review'));
            }
            else{
                return 'no exits';
          }
        }
        else{
              return 'no exits';
        }
    }

     function cart(Request $request){
        // dd(111);
        $prod_id = $request->cart_id;
        $prod_qty = $request->prod_qty;

        if(Auth::check()){

          $prod_check = Product::where('id',$prod_id)->first();
        //   dd($prod_check);
          if($prod_check){
            if(Cart::where('prod_id',$prod_id)->where('user_id', Auth::id())->exists())
            {
                      return response()->json(['status'=> $prod_check->name." Already Add To Cart"]);
            }else{

                $cart = new Cart();
                $cart->user_id = Auth::id();
                $cart->prod_id = $prod_id;
                $cart->prod_qty = $prod_qty;
                $cart->price = $prod_check->orignal_price * $prod_qty;
                $cart->save();
                return response()->json(['status'=> $prod_check->name." add to cart"]);
            }

            }



        }else{
            return ['status'=>'user is not logged in'];
        }
     }

     function viewCart(){

        $cart = Cart::where('user_id',Auth::id())->get();
        // dd($cart);
        return view('frontend.cart',compact('cart'));
     }

     function cart_delete(Request $request){
        $id = $request->id;
        $cart = Cart::find($id);
        // dd($cart->id);
        $cart->delete();
        return redirect()->back()->route('cart.del');
     }

     function cart_update(Request $request){

        // dd($request->all());

     $id = $request->id;
     $cart = Cart::find($id);
    //  dd($cart);
     $product_id = $cart->prod_id;
     $price = Product::where('id',$product_id)->first()->selling_price;
     $cart->exists = true;
     $cart->id = $id;
     $cart->prod_qty = $request->qty;
     $cart->price = $request->qty*$price;

    //  $price =
     $cart->save();

    return response()->json(['status'=> 'qauntity update successfully']);
}

  function checkout(){

       $cartnew = Cart::where('user_id',Auth::id())->get();
    //    $total_price = 0;
    //    foreach($cartnew as $total)
    //    {
    //     $total_price = $total_price + $total->price;
    //    }
    //    dd($total_price);
       foreach($cartnew as $item)
       {

            //   dd($check);

           if(! Product::where('id',$item->prod_id)->where('quantity','>=',$item->prod_qty)->exists())
           {


                $test = Cart::where('user_id',auth()->user()->id)->where('prod_id',$item->prod_id)->first();
                $test->delete();
            }


       }
       $cart = Cart::where('user_id',Auth::id())->get();
       return view('frontend.checkout',compact('cart'));
  }

     function order(Request $request){
    //    dd($request->all());

       $order = new Order();
       $order->user_id = Auth::id();
       $order->fname = $request->fname;
       $order->lname = $request->lname;
       $order->email = $request->email;
       $order->phone = $request->phone;
       $order->address1 = $request->address1;
       $order->address2 = $request->address2;
       $order->city = $request->city;
       $order->state = $request->state;
       $order->country = $request->country;
       $order->pincode = $request->pincode;
       $order->tracking_no = rand(0,1000);

       $order->save();

        $cartnew = Cart::Where('user_id',Auth::id())->with('products')->get();
        // dd($cartnew);
        foreach ($cartnew as $item){
// dd($item);
         OrderItem::create([
          'order_id' => $order->id,
          'prod_id' => $item->prod_id,
          'qty' => $item->prod_qty,
          'price' => $item->products->selling_price,

         ]);

        }

        if(Auth::user()->address1 == Null){

            $user = User::where('id',Auth::id())->first();
            $user->name = $request->fname;
            $user->lname = $request->lname;
            $user->phone = $request->phone;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pincode = $request->pincode;

            $user->save();


        }

        // return redirect()->route('order.table');

//Jazz cash start
    $cartnew = Cart::where('user_id',Auth::id())->get();
    $total_price = 0;
    foreach($cartnew as $total)
    {
     $total_price = $total_price + $total->price;
    }

         //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
      //1.
      //get formatted price. remove period(.) from the price
      $temp_amount    = $total_price*100;
      $amount_array   = explode('.', $temp_amount);
      $pp_Amount      = $amount_array[0];
      //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

      //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
      //2.
      //get the current date and time
      //be careful set TimeZone in config/app.php
      $DateTime       = new \DateTime();
      $pp_TxnDateTime = $DateTime->format('YmdHis');
      //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

      //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
      //3.
      //to make expiry date and time add one hour to current date and time
      $ExpiryDateTime = $DateTime;
      $ExpiryDateTime->modify('+' . 1 . ' hours');
      $pp_TxnExpiryDateTime = $ExpiryDateTime->format('YmdHis');
      //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

      //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
      //4.
      //make unique transaction id using current date
      $pp_TxnRefNo = 'T'.$pp_TxnDateTime;
      //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN

      //--------------------------------------------------------------------------------
      //$post_data

      $post_data =  array(
          "pp_Version"            => Config::get('constants.jazzcash.VERSION'),
          "pp_TxnType"            => 'MPAY',
          "pp_Language"           => Config::get('constants.jazzcash.LANGUAGE'),
          "pp_MerchantID"         => Config::get('constants.jazzcash.MERCHANT_ID'),
          "pp_SubMerchantID"      => '',
          "pp_Password"           => Config::get('constants.jazzcash.PASSWORD'),
          "pp_BankID"             => 'TBANK',
          "pp_ProductID"          => 'RETL',
          "pp_TxnRefNo"           => $pp_TxnRefNo,
          "pp_Amount"             => $pp_Amount,
          "pp_TxnCurrency"        => Config::get('constants.jazzcash.CURRENCY_CODE'),
          "pp_TxnDateTime"        => $pp_TxnDateTime,
          "pp_BillReference"      => "billRef",
          "pp_Description"        => "Description of transaction",
          "pp_TxnExpiryDateTime"  => $pp_TxnExpiryDateTime,
          "pp_ReturnURL"          => Config::get('constants.jazzcash.RETURN_URL'),
          "pp_SecureHash"         => "",
          "ppmpf_1"               => "1",
          "ppmpf_2"               => "2",
          "ppmpf_3"               => "3",
          "ppmpf_4"               => "4",
          "ppmpf_5"               => "5",
      );

      $pp_SecureHash = $this->get_SecureHash($post_data);

      $post_data['pp_SecureHash'] = $pp_SecureHash;

      $values = array(
          'TxnRefNo'    => $post_data['pp_TxnRefNo'],
          'amount'      => $total_price,
          'description' => $post_data['pp_Description'],
          'status'      => 'pending',
          'user_id'     => Auth::user()->id
      );
      Sale::insert($values);
      Session::put('post_data',$post_data);
    //   echo '<pre>';
    //   print_r($post_data);
    //   exit;

      return view('frontend.do_checkout_v');
     }
             //NNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN
             private function get_SecureHash($data_array)
             {
                 ksort($data_array);

                 $str = '';
                 foreach($data_array as $key => $value){
                     if(!empty($value)){
                         $str = $str . '&' . $value;
                     }
                 }

                 $str = Config::get('constants.jazzcash.INTEGERITY_SALT').$str;
                 $pp_SecureHash = hash_hmac('sha256', $str, Config::get('constants.jazzcash.INTEGERITY_SALT'));
                return $pp_SecureHash;
             }
             public function paymentStatus(Request $request)
             {
                 $response = $request->input();
                //  echo '<pre>';
                //  print_r($response['pp_ResponseCode']); exit;

                 if($response['pp_ResponseCode'] == '000')
                 {
                     $response['pp_ResponseMessage'] = 'Your Payment has been Successful';
                     $values = array('status' => 'completed');
                         Sale::where('TxnRefNo',$response['pp_TxnRefNo'])
                             ->update(['status' => 'completed']);
                 }

                 return view('frontend.payment-status',['response'=>$response]);
             }

     function cart_count(){

        $wish = Cart::where('user_id',Auth::id())->count();
        // dd($wish);
        Session::put('cartcount',$wish);
        // dd(session()->all());
        return response()->json(['msg'=> $wish]);

    }

    function auto_search(Request $request){

        // dd($request->all());

 $products =  Product::where('name', 'LIKE', '%' . $request->name . '%')->get();
   return view('frontend.auto',compact('products'))->render();



    }

    function rating(Request $request){
        //  dd($request->all());
        $rat = $request->product_rating;
        // dd($rat);
        $prod_id = $request->prod_id;
        // dd($prod_id);
        $prod_check = Product::where('id',$prod_id)->where('status',1)->get();
        // dd($prod_check);

        if($prod_check){
            $verify = Order::where('orders.user_id',Auth::id())->join('order_items','order_id','order_items.order_id')
            ->where('order_items.prod_id',$prod_id)->get();
            // dd($verify);

            if($verify){

                $test =  Rating::create([
                 'user_id' => Auth::id(),
                 'prod_id' => $prod_id,
                 'prod_rat' => $rat
                ]);
                // dd($test);
                return redirect()->back()->with('msg','thanks for rating this product');
            }

        }
        else{
            // dd('out');
            return redirect()->back()->with('msg','you cannot rate this product without purchase');
        }
    }

      function desreview($slug){
        //   dd(32);
        $product = Product::where('slug',$slug)->where('status',1)->first();
        // dd($product->slug);
        if($product){

            $product_id = $product->id;

            $verify = Order::where('orders.user_id',Auth::id())->join('order_items','orders.id','=','order_items.order_id')
            ->where('order_items.prod_id',$product_id)->get();

            // dd($verify);
              return view('frontend.review',compact('product','verify'));


        }else{
            return redirect()->back()->with('msg','the link you follow was broken');
        }
        //    return view('frontend.review');
      }
      function review_des(Request $request){

        // dd($request->all());
        $product_id = $request->product_id;
        // dd($product_id);
        $product = Product::where('id',$product_id)->where('status',1)->first();
        // dd($product);
        if($product)
        {
            Review::create(['user_id' => Auth::id(), 'prod_id' => $product_id, 'review' => $request->review]);
        }
            return redirect()->back();

      }
        //  function reviewShow(){
        //     $review = Review::get();
        //     // dd($review);
        //     return view('frontend.prod_view',compact('review'));
        //  }

       //stripe payment
      public function stripePost(Request $request)
      {
        // dd(232);
        // dd($request->all());
        $cartnew = Cart::where('user_id',Auth::id())->get();
        // dd($cartnew->price);
        $total_price = 0;
        foreach($cartnew as $total)
        {
         $total_price = $total_price + $total->price;

        }
        // dd( $total_price);
          Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
         $a= Stripe\Charge::create ([
                  "amount" => $total_price * 100,
                  "currency" => "usd",
                  "source" => $request->stripeToken,
                  "description" => "latest"
          ]);

        //   dd($a['amount']);
        // Session::flash('success', 'Payment successful!');

          return view('frontend.stripe')->with('success','Payment With Stripe successful');

      }

     function generatePDF(){

        $pdf = PDF::loadView('frontend.stripe',$success);

        return $pdf->download('umair brandz');
     }

     public function createTransaction()
     {
         return view('frontend.paypal');
     }

     /**
      * process transaction.
      *
      * @return \Illuminate\Http\Response
      */
     public function processTransaction(Request $request)
     {
         $provider = new PayPalClient;
         $provider->setApiCredentials(config('paypal'));
         $paypalToken = $provider->getAccessToken();

         $response = $provider->createOrder([
             "intent" => "CAPTURE",
             "application_context" => [
                 "return_url" => route('successTransaction'),
                 "cancel_url" => route('cancelTransaction'),
             ],
             "purchase_units" => [
                 0 => [
                     "amount" => [
                         "currency_code" => "USD",
                         "value" => "1000.00"
                     ]
                 ]
             ]
         ]);

         if (isset($response['id']) && $response['id'] != null) {

             // redirect to approve href
             foreach ($response['links'] as $links) {
                 if ($links['rel'] == 'approve') {
                     return redirect()->away($links['href']);
                 }
             }

             return redirect()
                 ->route('createTransaction')
                 ->with('error', 'Something went wrong.');

         } else {
             return redirect()
                 ->route('createTransaction')
                 ->with('error', $response['message'] ?? 'Something went wrong.');
         }
     }

     /**
      * success transaction.
      *
      * @return \Illuminate\Http\Response
      */
     public function successTransaction(Request $request)
     {
         $provider = new PayPalClient;
         $provider->setApiCredentials(config('paypal'));
         $provider->getAccessToken();
         $response = $provider->capturePaymentOrder($request['token']);

         if (isset($response['status']) && $response['status'] == 'COMPLETED') {
             return redirect()
                 ->route('createTransaction')
                 ->with('success', 'Transaction complete.');
         } else {
             return redirect()
                 ->route('createTransaction')
                 ->with('error', $response['message'] ?? 'Something went wrong.');
         }
     }

     /**
      * cancel transaction.
      *
      * @return \Illuminate\Http\Response
      */
     public function cancelTransaction(Request $request)
     {
         return redirect()
             ->route('createTransaction')
             ->with('error', $response['message'] ?? 'You have canceled the transaction.');
     }


    }
