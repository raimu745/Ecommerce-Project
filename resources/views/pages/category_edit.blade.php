@extends('admin.index')

@section('title','category')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title ">Add Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('category.update',$category->id)}}" method="Post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="inputFirstname">Name</label>
                        <input type="text" class="form-control" id="inputFirstname" placeholder="First name" name="name" value="{{old('name',$category->name)}}">
                    </div>
                    <div class="col-sm-6">
                        <label for="inputLastname">Slug</label>
                        <input type="text" class="form-control" id="inputLastname" placeholder="Last name" name="slug" value="{{$category->slug}}">
                    </div>
                </div>
                
                  <div class="form-group">
                   <label >Description</label>
                   <textarea class="form-control"  name="description" rows="4" placeholder="Textarea content..">{{$category->description}}</textarea>
                    </div>
                 
                  <div class="form-group row">
                    <div class=" col-sm-6">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$category->status == '1' ? 'checked' : ''}}>
                    <label class="form-check-label" for="exampleCheck1">Status</label>
                  </div>
                  </div>
                  <div class="col-sm-6">
                <div class="form-check ">
                    <input type="checkbox" class="form-check-input" name="popular" {{$category->popular == '1' ? 'checked' : ''}}>
                    <label class="form-check-label" for="exampleCheck1">Popular</label>
                  </div>
                </div>
                </div>
               <!-- end check -->
               <div class="form-group">
               <label for="inputFirstname">Meta Title</label>
                <input type="text" class="form-control" name="meta_title" placeholder="First name" value="{{old('meta_title',$category->meta_title)}}">
                    </div>
                
               <div class="form-group">
               <label for="inputFirstname">Meta Keywords</label>
               <input type="text" class="form-control" name="meta_descrip" placeholder="First name" value="{{$category->meta_descrip}}">
               </div>    
                    
               <div class="form-group">
               <label for="inputFirstname">Meta Description</label>
               <input type="text" class="form-control" name="meta_keywords" placeholder="First name" value="{{old('meta_keywords',$category->meta_keywords)}}">
               </div>  
             @if($category->image)
               <img src="{{asset('uploads/category/'.$category->image)}}" width="70" height="70" alt="image">
             @endif
                  <div class="my-2">
                    
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