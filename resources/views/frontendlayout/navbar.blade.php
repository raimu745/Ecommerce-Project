
    <style>
        .search-parent{
            position: relative;
        }
        .append-search-data{
                position: absolute;
                z-index: 121121;
                padding: 10px 20px;
        }
    </style>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">E-SHOP</a>

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      <div class="search-parent">
        <div class="searchbar" >
            <div class="mb-3">
              <label for=""></label>
                <input  class="form-control " type="search" id="tags">
              </div>

        </div>
        <div class="append-search-data">

        </div>
      </div>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('eshop')}}">Home</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('view.cart')}}">Cart
                      <span class="badge badge-pill bg-danger cartCount"> {{session()->get('cartcount')}}</span>
                  </a>

              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{url('wishlist')}}">WishList
                  <span class="badge badge-pill bg-danger  countwishes"> {{ session()->get('cart_value') }}</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{route('order.table')}}">Order</a>
                </li>
              {{-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('view_category/{slug}')}}">Category</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('register')}}">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{url('login')}}">Login</a>
              </li>


              </li>

            </ul>

          </div>
        </div>

      </nav>






