@extends('frontendlayout.master')

@section('content')


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Checkout example · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/checkout/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/ext-css/css')}}">
<link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container">
  {{-- <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h2>Checkout form</h2>
    <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
  </div> --}}

  <div class="row mt-5">

      <div class="col-md-4 order-md-2 mb-4 ">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
       <div  class="card">
           <div class="card-body">
             <h2>Order Now</h2>
             <hr>
             <table>
              <tr>
               <th>Name</th>
               <th>Quantity</th>
               <th>Price</th>
               </tr>
              <tbody>
                @foreach ($cart as $item)

                   <td>{{ucfirst($item->products->name)}}</td>
                   <td class="text-center">{{$item->prod_qty}}</td>
                   <td>{{$item->products->selling_price}}</td>

               </tr>
               @endforeach
            </tbody>
             </table>
             <hr>
             <a href="#" class="btn btn-success float-end">Buy Now</a>

           </div>
           </div>












    </div>


    {{-- billing --}}
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
      {{-- <form action="{{url('order')}}" method="post"> --}}
      <form action="{{url('order')}}" method="post">
        @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value=" {{ Auth::user()->name}} " name="fname" >
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="{{ Auth::user()->lname}} "  name="lname">
          </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Email</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="  {{ Auth::user()->email}} "  name="email" >
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Phone Number</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value=" {{ Auth::user()->phone }} " name="phone" >
            </div>
          </div>


          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Address1</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="{{ Auth::user()->address1 }}"  name="address1">
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Address2</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="{{ Auth::user()->address2 }}" name="address2" >
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">City</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="{{ Auth::user()->city }}" name="city">
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">State</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="{{ Auth::user()->state }}" name="state">
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">Country</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="{{ Auth::user()->country }}" name="country">
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">PinCode</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="{{ Auth::user()->pincode  }}" name="pincode">
            </div>
          </div>


          <button class="btn btn-danger" type="submit">Jazz Cash Payment</button>

          {{-- <button class="btn btn-primary" type="submit">Payment with stripe</button> --}}
          {{-- <a href="{{url('stripe')}}" class="btn btn-primary">Payment with stripe</a> --}}
      </form>

    </div>
  </div>

          <!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Payment With Stripe
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment With Stripe</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         {{-- form --}}
         <form
         role="form"
         action="{{ route('stripe.post') }}"
         method="post"
         class="require-validation"
         data-cc-on-file="false"
         data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
         id="payment-form">
     @csrf

     <div class='form-row row'>
         <div class='col-xs-12 form-group required'>
             <label class='control-label'>Name on Card</label> <input
                 class='form-control' size='4' type='text'>
         </div>
     </div>

     <div class='form-row row'>
         <div class='col-xs-12 form-group required'>
             <label class='control-label'>Card Number</label> <input
                 autocomplete='off' class='form-control card-number' size='20'
                 type='text'>
         </div>
     </div>

     <div class='form-row row'>
         <div class='col-xs-12 col-md-4 form-group cvc required'>
             <label class='control-label'>CVC</label> <input autocomplete='off'
                 class='form-control card-cvc' placeholder='ex. 311' size='4'
                 type='text'>
         </div>
         <div class='col-xs-12 col-md-4 form-group expiration required'>
             <label class='control-label'>Expiration Month</label> <input
                 class='form-control card-expiry-month' placeholder='MM' size='2'
                 type='text'>
         </div>
         <div class='col-xs-12 col-md-4 form-group expiration required'>
             <label class='control-label'>Expiration Year</label> <input
                 class='form-control card-expiry-year' placeholder='YYYY' size='4'
                 type='text'>
         </div>
     </div>



     <div class="row mt-2">
         <div class="col-xs-12">
             <button class="btn btn-primary" type="submit">Pay Now </button>
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
     </div>

 </form>
      </div>
    </div>
  </div>
</div>
{{-- modal end  --}}
      {{-- paypal --}}

      <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}"> Pay With PayPal </a>

      @if(\Session::has('error'))
          <div class="alert alert-danger">{{ \Session::get('error') }}</div>
          {{ \Session::forget('error') }}
      @endif
      @if(\Session::has('success'))
          <div class="alert alert-success">{{ \Session::get('success') }}</div>
          {{ \Session::forget('success') }}
      @endif

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
$(function() {

    var $form         = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

  });

  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script><script src="https://getbootstrap.com/docs/4.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
        <script src="https://getbootstrap.com/docs/4.3/examples/checkout/form-validation.js"></script>
    </body>
</html>

@endsection
