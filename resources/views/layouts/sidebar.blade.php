  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('Painel.index')}}" class="brand-link text-center">
      
      <span class="brand-text font-weight-light ">Alumade</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @if ($user->can('admin') || $user->can('comprador') || $user->can('cadastro'))
            <li class="nav-item">
              <a href="{{route('Painel.index')}}" class="nav-link">
                <i class="fas fa-home nav-icon"></i>
                <p>Principal</p>
              </a>
            </li>
          @endif
          @if ($user->can('admin') || $user->can('cadastro'))
            <li class="nav-item">
              <a href="{{route('Painel.Produto.index')}}" class="nav-link">
                <i class="fas fa-store nav-icon"></i>
                <p>Produto</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('Painel.Etapa.index')}}" class="nav-link">
                <i class="fas fa-bars-progress nav-icon"></i>
                <p>Etapas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('Painel.Campo.index')}}" class="nav-link">
                <i class="fas fa-chart-simple nav-icon"></i>
                <p>Campos</p>
              </a>
            </li>
          @endif
          @if ($user->can('admin') || $user->can('comprador') || $user->can('cadastro'))
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fas fa-cart-shopping nav-icon"></i>
                
                <p>
                  Pedidos
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('Painel.Pedido.index')}}" class="nav-link">
                    <i class="fa-solid fa-cart-flatbed nav-icon"></i>
                    <p>Fazer Pedido</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('Painel.Pedido.Realizados.index')}}" class="nav-link">
                    <i class="fa-solid fa-bag-shopping nav-icon"></i>
                    <p>Realizados</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
          @if ($user->can('admin') || $user->can('cadastro'))
            <li class="nav-item">
              <a href="{{route('Painel.Relacionamento.index')}}" class="nav-link">
                <i class="fa-solid fa-circle-nodes nav-icon"></i>
                <p>Relationship</p>
              </a>
            </li>
          @endif
          @if ($user->can('admin'))
            <li class="nav-item">
              <a href="{{route('Painel.Usuarios.index')}}" class="nav-link">
                <i class="fa-solid fa-users nav-icon"></i>
                <p>Usuários</p>
              </a>
            </li>
          @endif
          @if ($user->can('admin'))
            <li class="nav-item">
              <a href="{{route('Painel.Setores.index')}}" class="nav-link">
                <i class="fa-solid fa-users-gear nav-icon"></i>
                <p>Setores</p>
              </a>
            </li>
          @endif
          @if ($user->can('admin'))
          <li class="nav-item">
            <a href="{{route('Painel.Producao.index')}}" class="nav-link">
              <i class="fa-solid fa-gears nav-icon"></i>
              <p>Produção</p>
            </a>
          </li>
        @endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="m-0">Painel de Controlo</h4>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{route('Painel.index')}}">Home</a></li>
                                @if (isset($urlAtual))
                                <li class="breadcrumb-item active">{{$urlAtual}}</li>
                                @else
                                <li class="breadcrumb-item active">Pagina Principal</li>
                                @endif
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->