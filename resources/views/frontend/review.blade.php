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

    </style>
  </head>

 <div class="container mt-5">
    <div class="row">


        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if($verify->count() > 0)

                    <h2>You Are Writting Review {{$product->name}} </h2>

                    <form action="{{url('review_des')}}" method="post" >
                     @csrf
                     <input type="hidden" name="product_id" value="{{$product->id}}" >
                    <textarea name="review" id="" cols="30" rows="10" class="form-control" placeholder="write a new description"></textarea>
                    <input type="submit" class="btn btn-success mt-3" value="submit">
                   </form>

                    @else
                        <div class="alert alert-danger">
                           <h1>you are not eligible to write a review</h1>
                           <p>
                            customer how purchase the product they can review a product
                           </p>
                           <a href="" class="btn btn-primary">Go Back</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
 </div>



@endsection
