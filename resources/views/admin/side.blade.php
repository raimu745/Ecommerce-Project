<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->



          <li class="nav-item">
                <a href="{{url('dashboard')}}" class="nav-link  {{ request()->is('dashboard') ? 'active' : ''}}  ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard </p>
                </a>
              </li>

              <li class="nav-item">
            <a href="{{route('category.index')}}" class="nav-link  {{ request()->is('category') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item " >
            <a href="{{route('category.table')}}" class="nav-link  {{ request()->is('category_table') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Categories Table
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('product.index')}}" class="nav-link  {{ request()->is('product') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Product
              </p>
            </a>
</li>
            <li class="nav-item " >
            <a href="{{route('product.table')}}" class="nav-link  {{ request()->is('product_table') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
              Product Table
              </p>
            </a>
          </li>
          <li class="nav-item " >
            <a href="{{route('order')}}" class="nav-link  {{ request()->is('order') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
             Order
              </p>
            </a>
          </li>
          <li class="nav-item " >
            <a href="{{url('user')}}" class="nav-link  {{ request()->is('user') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
             User
              </p>
            </a>
          </li>












        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
