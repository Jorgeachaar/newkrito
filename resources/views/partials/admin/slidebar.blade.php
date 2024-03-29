<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        {{-- <div class="pull-left image">
          <img src="{{ asset('plugins/adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div> --}}

      <!-- search form (Optional) -->
      {{-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        {{-- <li class="header">PICS</li>
        <li class="treeview">
          <a href="#" class="{{ isActiveToArray(['picCategories.index']) }}"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="{{ isActiveToArray(['picCategories.index']) }}" href="{{ route('picCategories.index') }}">Categorias</a></li>
            <li><a class="{{ isActiveToArray(['']) }}" href="#">Link in level 2</a></li>
          </ul>
        </li>
        <li class="header">VIDEOS</li> --}}
        <li class="{{ isActiveToArray(['setting.edit']) }}"><a href="{{ route('setting.edit') }}"><i class="fa fa-link"></i> <span>Configuración</span></a></li>
        <li class="{{ isActiveToArray(['picCategories.index']) }}"><a href="{{ route('picCategories.index') }}"><i class="fa fa-link"></i> <span>Pics</span></a></li>
        <li class=""><a href="{{ route('videos.index') }}"><i class="fa fa-link"></i> <span>Videos</span></a></li>
        <li class=""><a href="{{ route('posts.index') }}"><i class="fa fa-link"></i> <span>Post</span></a></li>
        <li class=""><a href="{{ route('productCategory.index') }}"><i class="fa fa-link"></i> <span>Products</span></a></li>
        <li class=""><a href="{{ route('orders.index') }}"><i class="fa fa-link"></i> <span>Pedidos</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>