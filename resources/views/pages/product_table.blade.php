@extends('admin.index')

@section('title','category')

@section('content')


<div class="container ">
    <div class="row">
        <div class="col-10">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#Id</th>
      <th scope="col">Category</th>
      <th scope="col">name</th>
      <th scope="col">Description</th>
      <th scope="col">Orignal Price</th>
      <th scope="col">Selling Price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
    @php $i=1;  @endphp
  <tbody>
    @foreach ($product as $item)
    <tr>
    <td>{{$i++}}</td>
      <td>{{$item->category->name}}</td>
      <td>{{$item->name}}</td>
      <td>{{$item->description}}</td>
      <td>{{$item->orignal_price}}</td>
      <td>{{$item->selling_price}}</td>
      <td>
        <img src="{{asset('uploads/product/'.$item->image)}}" width="70" height="70"  alt="image">
      </td>
      <td>
      <a href="{{route('product.edit',['id'=>encrypt($item->id)])}}" class="btn btn-outline-success">Edit</a>
        <a href="{{route('product.delete',['id'=>encrypt($item->id)])}}" class="btn btn-outline-danger">Trash</a>
      </td>
    </tr>
   @endforeach
  </tbody>
</table>


        </div>
    </div>
</div>





@endsection
