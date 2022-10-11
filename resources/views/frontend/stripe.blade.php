@extends('frontendlayout.master')

@section('content')




<div class="conteiner mt-5">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">

            <div class="alert alert-success text-center" role="alert">
                <h4 class="alert-heading"> {{$success}} </h4>
                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                <hr>
                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
              </div>

              <a href="{{url('generate-pdf')}}" class="btn btn-primary">Print Now</a>

        </div>
        <div class="col-2"></div>

    </div>
</div>


@endsection
