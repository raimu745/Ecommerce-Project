@extends('frontendlayout.master')

@section('content')

<head>
    <style>

    </style>
</head>

<div class="row  cartdel">
    @php $total = 0; @endphp

    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

      <!-- Shopping cart table -->
      <div class="table-responsive">
        <table class="table ">
          <thead>
            <tr>
              <th scope="col" class="border-0 bg-light">
                <div class="p-2 px-3 text-uppercase">Image</div>
              </th>
              <th scope="col" class="border-0 bg-light">
                <div class="py-2 text-uppercase">Product Name</div>
              </th>
              <th scope="col" class="border-0 bg-light">
                <div class="py-2 te
                xt-uppercase">Orignal Price</div>
              </th>
              <th scope="col" class="border-0 bg-light">
                <div class="py-2 text-uppercase">Quantity</div>
              </th>
              <th scope="col" class="border-0 bg-light">
                <div class="py-2 text-uppercase">Total Price</div>
              </th>
              <th scope="col" class="border-0 bg-light">
                <div class="py-2 text-uppercase">Trash</div>
              </th>
            </tr>
          </thead>
          <tbody>

            @foreach ($cart as $item)


            <tr class="border-5">
              <th scope="row">
                <div class="p-2">
                  <img src="{{asset('uploads/product/'.$item->products->image)}}" alt="" width="70" class="img-fluid rounded shadow-sm">
                  <div class="ml-3 d-inline-block align-middle">

                  </div>
                </div>
              </th>
              <td class=" align-middle"><strong>{{ucfirst($item->products->name)}}</strong></td>

                <td class=" align-middle">{{ucfirst($item->products->selling_price)}}</strong></td>


              <td class=" align-middle">
                @if ($item->products->quantity > $item->prod_qty)

                <input id="demoInput{{ $item->id }}" type=number min=1  max=10 value="{{$item->prod_qty}}">
                <button onclick="increment('{{ $item->id }}')" class="update">+</button>
               <button onclick="decrement('{{ $item->id }}')" class="update">-</button>

               @php $total +=  $item->products->selling_price * $item->prod_qty;  @endphp


                @else
                     <h1 class="badge bg-primary">out of stock</h1>
                @endif
                </td>

                <td class="align-middle">
                    @php
                        $sum = $item->products->selling_price * $item->prod_qty;
                        echo $sum;
                    @endphp
                </td>
                {{-- <td class=" align-middle">{{$item->prod_qty*$item->products->orignal_price}}</strong></td> --}}
              <td class="align-middle"> <button type="submit" class="btn btn-danger del" data-id='{{$item->id}}'>Trash</button></td>

              <td class=" align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>

            </tr>
            {{-- @php $total +=  $item->products->selling_price * $item->prod_qty;  @endphp --}}

            @endforeach
            {{-- <tr>
              <th scope="row">
                <div class="p-2">
                  <img src="https://bootstrapious.com/i/snippets/sn-cart/product-2.jpg" alt="" width="70" class="img-fluid rounded shadow-sm">
                  <div class="ml-3 d-inline-block align-middle">
                    <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">Lumix camera lense</a></h5><span class="text-muted font-weight-normal font-italic">Category: Electronics</span>
                  </div>
                </div>
              </th>
              <td class="align-middle"><strong>$79.00</strong></td>
              <td class="align-middle"><strong>3</strong></td>
              <td class="align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a>
              </td>
            </tr> --}}

          </tbody>

        </table>

      </div>
      <!-- End -->

      <h1>Sub-Total price : {{$total}}</h1>
      <a  href="{{url('checkout')}}" class="btn btn-success float-end">Proceed To check-Out</a>
    </div>
  </div>


@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function increment(id) {
       document.getElementById('demoInput'+id).stepUp();
       let qty = $('#demoInput'+id).val();
       $.ajax({
            url: "{{ url('cart_update')}}",
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': "<?= Session::token() ?>"
            },
            dataType: "json",
            data:{
                id : id,
                qty:qty,
            },
            cache: false,
            success: function (response) {
                window.location.reload();
                // console.log(response);

            }
        })
    }
    function decrement(id) {
       document.getElementById('demoInput'+id).stepDown();
       let qty = $('#demoInput'+id).val();
       $.ajax({
            url: "{{ url('cart_update')}}",
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': "<?= Session::token() ?>"
            },
            dataType: "json",
            data:{
                id : id,
                qty:qty,
            },
            cache: false,
            success: function (response) {
                window.location.reload();
                // console.log(response);

            }
        })
    }
 </script>

<script>
    $(document).ready(function(){

        $('.del').on('click',function(e){
       e.preventDefault();
        let id = $(this).attr('data-id');

        $.ajax({
                    url: "{{ url('cart_delete')}}",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': "<?= Session::token() ?>"
                    },
                    dataType: "json",
                    data:{
                      id : id,
                    },

                    cache: false,

                    success: function (response) {
                       alert(response.status);

                       $('.cartdel').load(window.href+ " .cartdel");

                    }
                })
    });



    });


    /////////////////////////////// cart count ////////////////



</script>

<script>
    cartCount();
      function cartCount(){

        $.ajax({
                    url: "{{ url('cart_count')}}",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': "<?= Session::token() ?>"
                    },
                    dataType: "json",


                    cache: false,

                    success: function (response) {
                        // wishCount();
                        // console.log(response.msg);

                        // $('.cartCount').html('');
                        // $('.cartCount').html(response.msg);
                        // alert(response.msg);

                    }


                })
            }
</script>


