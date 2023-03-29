    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{asset('AdminLTE/dist/img/logo.png')}}" alt="Alumade" height="60" width="60">
    </div>
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
          <a href="#" class="nav-link" data-toggle="dropdown">
            <i class="fa-solid fa-user-large"></i>
            <span >{{$user->name}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="mr-3 mt-2">
                  <i class="fa-solid fa-circle-user fa-2xl"></i>
                </div>
                <div class="media-body" >
                  <h3 class="dropdown-item-title">
                    {{$user->name}}
                  </h3>
                  <p class="text-sm">admin</p>
                  
                </div>
              </div>
              <div class="float-right  btn-flat " style=" padding: .0rem .5rem .5rem .5rem !important;">
                <a class="btn btn-danger"
                  href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('sair') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
              </div>
            </a>
          </div>


      </li>
      

      
    </ul>
  </nav>
  <!-- /.navbar -->
