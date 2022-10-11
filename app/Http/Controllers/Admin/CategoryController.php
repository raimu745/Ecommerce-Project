<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CategoryController extends Controller
{
    function index(){
        return view('pages.category');
        
    } 
    function store(Request $request){
       
        $category = new Category();
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/category/', $filename);
            $category->image = $filename;
        }
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->input('status') == TRUE ? '1' : '0';
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';
        $category->meta_title = $request->meta_title;
        $category->meta_descrip = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();

        return redirect()->route('category.index');

    }
    public function show(){
        $category = Category::all();

        return view('pages.category_table',compact('category'));
    }
    function delete(Request $request){
        $id = decrypt($request->id);
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();

    }
    function edit(Request $request){
        $id = decrypt($request->id);
        $category = Category::find($id);
        return view('pages.category_edit',compact('category'));
    }
    function update(Request $request){
    //    dd(384);
    $id = $request->id;
    $category = Category::find($id);
    
        $image = null;
        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/category/', $filename);
            $image = $filename;
        }else{


            $image = $category->image;
        }
        $category = new Category();
        $category->exists = true;
         $category->id = $id;
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->input('status') == TRUE ? '1' : '0';
        $category->popular = $request->input('popular') == TRUE ? '1' : '0';
        $category->meta_title = $request->meta_title;
        $category->meta_descrip = $request->meta_descrip;
        $category->meta_keywords = $request->meta_keywords;
        $category->image = $image;
        $category->save();

        return redirect()->route('category.index');

    }
}
