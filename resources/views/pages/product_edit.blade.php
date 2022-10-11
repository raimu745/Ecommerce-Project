@extends('admin.index')

@section('title','Product')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title "> Add Product </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('product.update',encrypt($product->id))}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                <select class="form-select" name="cate_id" >
                <!-- <option selected>Open this select menu</option> -->
               
                 <option value="">{{$product->category->name}}</option>
               
                </select>
                    </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputFirstname">Name</label>
                        <input type="text" class="form-control" value="{{$product->name}}" placeholder="Product Name" name="name">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Slug</label>
                        <input type="text" class="form-control" value="{{old('slug',$product->slug)}}" placeholder="Slug" name="slug">
                    </div>
                </div>
                
                <div class="form-group">
                   <label >Small Description</label>
                   <textarea class="form-control"   name="sdescription" rows="4" placeholder="Textarea content..">{{old('sdescription',$product->small_description)}}</textarea>
                    </div>

                  <div class="form-group">
                   <label >Description</label>
                   <textarea class="form-control"  name="description" rows="4" placeholder="Textarea content..">{{old('sdescription',$product->description)}}</textarea>
                    </div>
                 
                    <div class="form-group row">
                    <div class=" col-sm-6">
                    <div class="form-check ">
                    <input type="checkbox" class="form-check-input" name="status" {{$product->status == '1' ? 'checked' : ''}}>
                    <label class="form-check-label"  for="exampleCheck1">Status</label>
                  </div>
                  </div>
                  <div class="col-sm-6">
                <div class="form-check ">
                    <input type="checkbox" class="form-check-input" name="trending" {{$product->trending == '1' ? 'checked' : ''}}>
                    <label class="form-check-label" for="exampleCheck1">Trending</label>
                  </div>
                </div>
                </div>


                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputFirstname">Orignal Price</label>
                        <input type="text" class="form-control"  placeholder="Orignal Price" name="oprice" value="{{$product->orignal_price}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Selling Price</label>
                        <input type="text" class="form-control" id="inputLastname" placeholder="Last name" name="sprice" value="{{$product->selling_price}}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputFirstname">Tax</label>
                        <input type="text" class="form-control"  placeholder="Tax" name="tax" value="{{$product->tax}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Quantity</label>
                        <input type="number" class="form-control" id="inputLastname" placeholder="Quantity" name="qty"  value="{{$product->quantity}}">
                    </div>
                </div>
               <!-- end check -->
               <div class="form-group">
               <label for="inputFirstname">Meta Title</label>
                <input type="text" class="form-control" name="meta_title" placeholder="First name" value="{{$product->meta_title}}">
                    </div>
                
               <div class="form-group">
               <label for="inputFirstname">Meta Keywords</label>
               <input type="text" class="form-control" name="meta_descrip" placeholder="First name" value="{{$product->meta_descrip}}">
               </div>    
                    
               <div class="form-group">
               <label for="inputFirstname">Meta Description</label>
               <input type="text" class="form-control" name="meta_keywords" placeholder="First name" value="{{$product->meta_keywords}}">
               </div>  
             @if($product->image)
               <img src="{{asset('uploads/product/'.$product->image)}}" width="70" height="70" alt="image">
               @endif
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" name="image">
                    </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </div>
                <!-- /.card-body -->

                
              </form>
            </div>
        
        
    </div>
    </div>
</div>

            <!-- general form elements -->
           
            <!-- /.card -->
          
           

         
@endsection