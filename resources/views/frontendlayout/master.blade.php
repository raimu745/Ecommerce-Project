<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{asset('front/owl-car/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/owl-car/owl.theme.default.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/external/css')}}">
    <link rel="stylesheet" href="{{asset('assets/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/slick/slick-theme.css')}}">

    <style>
        .carousel-item {
    height: 500px !important;
}
.whatsupp-chat{
    bottom: 10px;
    left: 10px;
    position: fixed;
}
    </style>
    {{--
    <style>
        .search-parent{
            position: relative;
        }
        .append-search-data{
            position: absolute;
    z-index: 121121;
    background-color: #7878d0;
    padding: 10px 20px;
        }
    </style> --}}
  </head>


  <body>
      @include('frontendlayout.navbar')
      @include('frontendlayout.slider')
        <div >
          @yield('content')
        </div>

        <div class="whatsupp-chat">
            <a href=" https://wa.me/+923076424460?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
            <img src="{{asset('assets/dist/img/ww.png')}}" width="70" height="70" alt="image" >
        </a>
        </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    <script src="{{asset('front/owl-car/owl.carousel.min.js')}}"></script>

    <link rel="stylesheet" href="{{asset('assets/slick/slick.min.js')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/632b40c954f06e12d896102e/1gdgfa56a';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
<script>
   $(document).ready(function () {

    // alert("g")

  $('#owl-demo1').slick({
  slidesToShow: 3,
  slidesToScroll: 5,
  autoplay: true,
  autoplaySpeed: 2000,
});



   })
 </script>
<script>

    $(document).ready(function(){

        $('#tags').on('keyup',function(e){

            e.preventDefault(e);

         let name = $(this).val();

            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: "{{ route('searchOnAll') }}",
            data: {
                name: name,
            },
            success: function(data) {
                console.log(data.msg);
                $('.append-search-data').html(data);

            }
        });

        });
    });
</script>

  </body>
</html>
