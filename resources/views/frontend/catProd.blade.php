@extends('frontendlayout.master')

@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{asset('front/owl-car/owl.carousel.min.css')}}"> 
    <link rel="stylesheet" href="{{asset('front/owl-car/owl.theme.default.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
      a{
        text-decoration: none !important;
      }
    </style>
  </head>


<div class="py-5" >
    <div class="container" >
    

<div class="row">

 <h2>Trending Product</h2>

    @foreach($products as $item)
    <div class="col-3">
    <a href="{{url('view_category/'.$category->slug .'/'.$item->slug)}}">
        <div class="card my-3 ">

            <img src="{{asset('uploads/product/'.$item->image)}}"  alt="image">
            <div class="card-body">
                <h1 class="text-center">{{ucfirst($item->name)}}</h1>
                <span class="float-start">{{$item->orignal_price}}</span>
                <span class="float-end"><s>{{$item->selling_price}}</s></span>
            </div>
          
        </div>
        </a>

    </div>
    @endforeach
   
</div>

</div>
</div>




@endsection

