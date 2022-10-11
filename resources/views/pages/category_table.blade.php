@extends('admin.index')

@section('title','category')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-10">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#Id</th>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
      
    </tr>
  </thead>
    @php $i=1;  @endphp
  <tbody>
    @foreach ($category as $item)
    <tr>
    <td>{{$i++}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->description}}</td>
      <td>
        <img src="{{asset('uploads/category/'.$item->image)}}" width="70" height="70"  alt="image">
      </td>
      <td>
      <a href="{{route('category.edit',['id'=>encrypt($item->id)])}}" class="btn btn-outline-success">Edit</a>
        <a href="{{route('category.delete',['id'=>encrypt($item->id)])}}" class="btn btn-outline-danger">Trash</a>
      </td>
    </tr>
   @endforeach
  </tbody>
</table>
        </div>
    </div>
</div>

          
           

         
@endsection