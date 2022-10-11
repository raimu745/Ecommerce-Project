@extends('frontendlayout.master')

@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{asset('front/owl-car/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/owl-car/owl.theme.default.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
      a{
        text-decoration: none !important;
      }
      .card-body{
        box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
      }



Star Rating Using HTML CSS
20-08-2021 | Share:


HTML :




CSS:

/* rating */
.rating-css div {
    color: #ffe400;
    font-size: 30px;
    font-family: sans-serif;
    font-weight: 800;
    text-align: center;
    text-transform: uppercase;
    padding: 20px 0;
  }
  .rating-css input {
    display: none;
  }
  .rating-css input + label {
    color:  #f5de15;
    font-size: 60px;
    text-shadow: 1px 1px 0 #8f8420;
    cursor: pointer;
  }
  .rating-css input:checked + label ~ label {
    color: #b4afaf;
  }
  .rating-css label:active {
    transform: scale(0.8);
    transition: 0.3s ease;
  }

/* End of Star Rating */
    </style>
  </head>



        <div class="container my-5 ">
            <div class="card-shadow">
                <div class="card-body">

                    {{-- model --}}

                      <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><h1>{{ucFirst($product->name)}}</h1></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                {{-- <input type="hidden" value="{{$product->id}}"> --}}
                                <form action="{{url('rating')}}" method="post">
                                    @csrf

                              <input type="hidden" name="prod_id" value="{{$product->id}}">
                                    <div class="rating-css">
                                        <div class="star-icon">
                                            <input type="radio" value="1" name="product_rating" checked id="rating1">
                                            <label for="rating1" class="fa fa-star"></label>
                                            <input type="radio" value="2" name="product_rating" id="rating2">
                                            <label for="rating2" class="fa fa-star"></label>
                                            <input type="radio" value="3" name="product_rating" id="rating3">
                                            <label for="rating3" class="fa fa-star"></label>
                                            <input type="radio" value="4" name="product_rating" id="rating4">
                                            <label for="rating4" class="fa fa-star"></label>
                                            <input type="radio" value="5" name="product_rating" id="rating5">
                                            <label for="rating5" class="fa fa-star"></label>
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Rate the Product</button>
                            </div>
                        </form>
                        </div>
                        </div>
                    </div>
                    {{-- model --}}
                    <div class="row">
                        <div class="col-md-4 border-light">
                            <img src="{{asset('uploads/product/'.$product->image)}}" class="w-100 h-100" alt="">

                        </div>
                        <div class="col-md-8">
                            <h2 class="mb-0">
                          <label for="" class="float-end badge bg-danger trending_tag mt-2 me-2">{{$product->trending=="1" ? 'trending' : ''}}</label>
                            <br>
                            </h2>
                            <hr>

                                {{-- {{ number_format($rat_val) }} --}}


                            <div class="rating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span>
                            @if ($rating->count()> 0)
                            {{$rating->count()}} Ratings
                            @else
                            No Rating
                            @endif

                            </span>
                            </div>

                            <label class="me-3" >Orignal Price : <s>Rs:{{$product->orignal_price}}</s></label>
                            <label class="fw-bold" >Selling Price : {{$product->selling_price}}</label>
                            <p class="mt-3">
                                 {!! $product->small_description !!}
                            </p>

                        <hr>


                         @if($product->quantity >0 )
                            <label class="badge bg-success">In Stock</label>
                        @else
                           <label class="badge bg-success">Out Off Stock</label>
                         @endif
                         <div class="row mt-2">
                            <div class="col-md-2">
                                <label for="">Quantity</label>
                              {{-- <input type="hidden" id="{{$product->id}}" class="qty"> --}}
                                <input id=demoInput type=number min=1  max=10 class="mb-3 qty_input" value="1">
                                  <button onclick="increment()">+</button>
                                 <button onclick="decrement()">-</button>
                            </div>
                        </div>

                           {{-- description --}}

                           {{-- description --}}
                        <div class="col-md-10">
                          <br>
                          @if($product->quantity > 0 )
                          <button type="button" class="btn btn-success cart me-float-start cart mb-3" id="{{$product->id}}" ><i class="fa-solid fa-cart-shopping"></i>Add To Cart</button>
                          @endif
                          <button type="button" class="btn btn-primary me-float-start mb-3 wish"  id="{{$product->id}}"><i class="fa-solid fa-heart"></i>Add To Whishlist</button>

                        </div>
                        {{-- h --}}
                        <hr>
                        <h1>Description</h1>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Rate This Product | {{$product->name}}
                                    </button>
                                <a href="{{url('description/'.$product->slug.'/review')}}" class="btn btn-outline-success mb-3">Review</a>
                            </div>
                          <div class="col-6">
                            {{-- @dd($review) --}}
                            <h3>{{ucfirst($product->name)}} Reviews</h3>
                            @foreach ($review as $item)

                                      <p>{{$item->review}} <span><i class="fa fa-star checked"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i></span></p>
                            @endforeach

                          </div>
                          {{-- <div class="rating">
                            <i class="fa fa-star checked"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div> --}}

                    </div>
                            </div>
                        </div>
                    </div>

                    </div>

                </div>
            </div>
        </div>

        {{-- star --}}


     {{-- modal --}}


@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>


    $(document).ready(function(){



        $('.cart').on('click',function(e){
            e.preventDefault();
            let cart_id = $(this).attr('id');
            let prod_qty = $('.qty_input').val();
            // alert(qty_id);
            // alert(cart_id);

     $.ajax({
                    url: "{{ url('cart')}}",
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': "<?= Session::token() ?>"
                    },
                    dataType: "json",
                    data:{
                      cart_id : cart_id,
                      prod_qty : prod_qty,
                    },

                    cache: false,

                    success: function (response) {
                       swal(response.status);


                    }
                })

    });


});
</script>

<script>
   function increment() {
      document.getElementById('demoInput').stepUp();
   }
   function decrement() {
      document.getElementById('demoInput').stepDown();
   }
</script>

<script>
    $(document).ready(function(){

        $('.wish').on('click',function(e){
            e.preventDefault();

           let id = $(this).attr('id');
        //    alert(id);

           $.ajax({
                    url: "{{ url('add_wish')}}",
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
                       swal(response.msg);


                    }
                })

        });


    })



</script>
