<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function index(){
         $category = Category::all();
        return view('pages.product',compact('category'));

    }
    function store(Request $request){
        // dd($request->all());
      $product = new Product();

      if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/product/', $filename);
            $product->image = $filename;
        }

      $product->cate_id = $request->cate_id;
      $product->name = $request->name;
      
      $product->slug = $request->slug;  
      $product->small_description = $request->sdescription;     
      $product->description = $request->description;  
      $product->status = $request->status; 
      $product->trending  = $request->trending;              
      $product->orignal_price  = $request->oprice;
      $product->selling_price  = $request->sprice; 
      $product->status = $request->input('status')== True ? '1' : '0';  
      $product->trending = $request->input('trending')== True ? '1' : '0'; 
      $product->tax  = $request->tax;
      $product->quantity = $request->qty;   
      $product->meta_title  = $request->meta_title;
      $product->meta_descrip    = $request->meta_descrip;
      $product->meta_keywords    = $request->meta_keywords;   
      $product->save();
      return redirect()->back();                       
   }
    function show(){

        $product = Product::all();
        return view('pages.product_table',compact('product'));

    }
    function destroy(Request $request){
        $id = decrypt($request->id);
        $product = Product::find($id);
        $product->delete();
        return redirect()->back();
    }
    function edit(Request $request){
        $id = decrypt($request->id);
        $product = Product::find($id);
        return view('pages.product_edit',compact('product'));
    }
    function update(Request $request){

        $id = decrypt($request->id);
        $productrequest = Product::find($id);
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/product/', $filename);
            $image = $filename;
         }
        else{
              $image = $productrequest->image;
            }
            $product = new Product();
            $product->exists = true;
        $product->id =  $id;
      $product->name = $request->name;
      $product->slug = $request->slug; 
       
      $product->small_description = $request->sdescription;     
      $product->description = $request->description;  
      $product->status = $request->status; 
                   
      $product->orignal_price  = $request->oprice;
      $product->selling_price  = $request->sprice; 
      $product->status = $request->input('status') == True ? '1' : '0';  
      $product->trending = $request->input('trending') == True ? '1' : '0'; 
      $product->tax  = $request->tax;
      $product->quantity = $request->qty;   
      $product->meta_title  = $request->meta_title;
      $product->meta_descrip    = $request->meta_descrip;
      $product->meta_keywords    = $request->meta_keywords;
      $product->image =  $image;    
      $product->save();
      return redirect()->route('product.table'); 

    }
}
