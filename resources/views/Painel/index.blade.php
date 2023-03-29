@extends('Painel.layout.index')

@section('content')
    <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            @if ($user->can('admin') || $user->can('cadastro'))
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary bg-gradient">
                  <div class="inner">
                    @inject('produto', 'App\Models\produto')
                    <h3>{{$produto->count()}}</h3>
    
                    <p>Produtos</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-store"></i>
                  </div>
                  <a href="{{route('Painel.Produto.index')}}" class="small-box-footer">Gerenciar <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            @endif
            <!-- ./col -->
            @if ($user->can('admin') || $user->can('cadastro'))
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success bg-gradient">
                <div class="inner">
                  @inject('etapa', 'App\Models\etapa')
                  <h3>{{$etapa->count()}}</sup></h3>
  
                  <p>Etapas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-bars-progress"></i>
                </div>
                <a href="{{route('Painel.Etapa.index')}}" class="small-box-footer">Gerenciar <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning bg-gradient">
                <div class="inner">
                  @inject('campo', 'App\Models\campo')
                  <h3>{{$campo->count()}}</h3>
  
                  <p>Campos</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-chart-simple"></i>
                </div>
                <a href="{{route('Painel.Campo.index')}}" class="small-box-footer">Gerenciar <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            @endif
            @if ($user->can('admin') || $user->can('comprador') || $user->can('cadastro'))
            <div class="col-lg-3 col-6">
            
              <!-- small box -->
              <div class="small-box bg-info bg-gradient">
                <div class="inner">
                  @inject('produto', 'App\Models\produto')
                  <h3>{{$produto->count()}}</h3>
  
                  <p>Fazer Pedidos</p>
                </div>
                <div class="icon">
                  <i class="fa fa-cart-shopping"></i>
                </div>
                <a href="{{route('Painel.Pedido.index')}}" class="small-box-footer">Lista Pedidos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger bg-gradient">
                <div class="inner">
                  @inject('pedidos', 'App\Models\pedido')
                  <h3>{{$pedidos->count()}}</h3>
  
                  <p>Pedidos Realizados</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-bag-shopping"></i>
                </div>
                <a href="{{route('Painel.Pedido.index')}}" class="small-box-footer">Gerenciar<i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            @endif
            @if ($user->can('admin') || $user->can('cadastro'))
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-dark bg-gradient">
                <div class="inner">
                  @inject('relacionamento', 'App\Models\relacionamento')
                  <h3>{{$relacionamento->count()}}</h3>
  
                  <p>Relacionamento</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-circle-nodes"></i>
                </div>
                <a href="{{route('Painel.Relacionamento.index')}}" class="small-box-footer">Gerenciar <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            @endif
            @if ($user->can('admin'))
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-secondary bg-gradient">
                <div class="inner">
                  @inject('User', 'App\Models\User')
                  <h3>{{$User->count()}}</h3>
  
                  <p>Usuarios</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-users"></i>
                </div>
                <a href="{{route('Painel.Usuarios.index')}}" class="small-box-footer">Lista Usuarios <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-light bg-gradient">
                <div class="inner">
                  @inject('User', 'App\Models\User')
                  <h3>{{$User->count()}}</h3>
  
                  <p>Setores</p>
                </div>
                <div class="icon">
                  <i class="fa-solid fa-users-gear"></i>
                </div>
                <a href="{{route('Painel.Setores.index')}}" class="small-box-footer">Lista Usuarios <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            @endif

          </div>
          <!-- /.row -->
          
    </div><!-- /.container-fluid -->
  </section>
      <!-- /.content -->

@endsection