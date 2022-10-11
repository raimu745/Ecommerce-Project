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
            <table class="table table-bordered">
               <thead>
                <th>Tracking Number</th>
                <th>Total Price</th>
                <th>Status</th>
                <th>Action</th>
               </thead>
               <tbody>
                @foreach ( $order  as $item )
                <tr>
                  <td>{{ $item->tracking_no}}</td>
                  <td>{{ $item->tracking_no}}</td>
                  <td>{{ $item->status == 0 ? 'pendening' : 'completed'}}</td>
                  <td>
                    <a href="{{'view_order/'.$item->id}}" class="btn btn-primary">View</a>
                  </td>
                </tr>
                @endforeach
               </tbody>

            </table>
        </div>
    </div>
 </div>








@endsection

