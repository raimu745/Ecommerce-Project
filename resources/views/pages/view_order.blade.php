@extends('admin.index')

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

 <div class="container my-5">
  <div class="row">

       
            {{--  --}}
            <div class="col-6">
                <label for="">First Name</label>
                <div class="border p-2">{{$order->fname}}</div>

                <label for="">Last Name</label>
                <div class="border p-2">{{$order->lname}}</div>

                <label for="">Email</label>
                <div class="border p-2">{{$order->email}}</div>

                <label for="">Contact no</label>
                <div class="border p-2">{{$order->phone}}</div>

                <label for="">Shipping Address</label>
                <div class="border p-2">
                   {{$order->address1}},
                   {{$order->address2}},
                   {{$order->city}},
                   {{$order->state}},
                   {{$order->country}}
               </div>

               <label for="">PinCode</label>
               <div class="border p-2">{{$order->pincode}}</div>

               </div>
               <div class="col-6">
                 <table class="table table-borderd">
                   <thead>
                       <th>Name</th>
                       <th>Quantity</th>
                       <th> price</th>
                       <th>Image</th>

                       <th></th>
                   </thead>
                    <tbody>
                      {{-- @dd($order) --}}
                       @foreach ($order->orderitems as $item)

                        <tr>
                           <td class="align-middle">{{$item->products->name}}</td>
                           <td class="align-middle">{{$item->qty}}</td>
                           <td class="align-middle">{{$item->price}}</td>
                           <td>
                               <img src="{{asset('uploads/product/'.$item->products->image)}}" width="70" height="70" alt="image">
                           </td>
                        </tr>
                       @endforeach
                    </tbody>
                 </table>
                 <h3><strong> Grand Total <strong> : <span class="float-end">{{$order->total_price}}</span></h3>


                    <form action="{{url('update_status/'.$order->id)}}" method="post">
                        @csrf
                    <select class="form-select" name="status_order">
                        <option {{$order->status==0 ? 'pending' : ''}} value="0">Pending</option>
                        <option {{$order->status==1 ? 'completed' : ''}} value="1">completed</option>
                      </select>

                       <input type="submit" class="btn btn-primary mt-3" value="update">
                    </form>
               </div>
            {{--  --}}




</div>
</div>



@endsection
