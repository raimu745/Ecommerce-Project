@extends('frontendlayout.master')
@section('content')
<div class="container">
    <div class="status" style="margin-top: 50px; text-align:center">
	<?php $post_data = Session::get('post_data');?>

        @if($response['pp_ResponseCode'] == '000')
		<!-- --------------------------------------------------------------------------- -->
		<!-- Payment successful -->
        {{-- @dd('here'); --}}
            <h1 class="success">Your Payment has been Successful</h1>
            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> {{ $response['pp_RetreivalReferenceNo'] }}</p>
            <p><b>Transaction ID:</b> {{ $response['pp_TxnRefNo'] }}</p>
            <p><b>Paid Amount:</b> {{ $response['pp_Amount']/100 }}</p>
            <p><b>Payment Status:</b> Success</p>
		<!-- --------------------------------------------------------------------------- -->


		<!-- --------------------------------------------------------------------------- -->
        <!-- Payment not successful -->
		@elseif($response == '124')
            <h1 class="error">Your Payment has been on Waiting satate</h1>
			<p><b>Message: </b>{{ $response['pp_ResponseMessage'] }}</p>
			<p><b>Voucher Number: </b>{{ $response['pp_RetreivalReferenceNo'] }}</p>
		<!-- --------------------------------------------------------------------------- -->


		<!-- --------------------------------------------------------------------------- -->
        <!-- Payment not successful -->
		@else
            <h1 class="error">Your Payment has Failed</h1>
			<p><b>Message: </b>{{ $response['pp_ResponseMessage'] }}</p>
        @endif
		<!-- --------------------------------------------------------------------------- -->


    </div>
    <a href="#" class="btn-link">Back to Products</a>
</div>
@endsection
