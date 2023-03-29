@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="col-12">

        {{-- TABELA PRODUTO --}}
        <div class="card">
            <div class="card-header">
                <h5 class="">Fazer Pedidos</h5>
                <a href="{{route('Painel.index')}}" class="btn btn-success btn-sm"
                            title="Retornar Painel" >
                        <i class="fas fa-chart-simple nav-icon"></i>
                        Voltar</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Código Produto</th>
                            <th>Nome</th>

                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($produto as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            
                            <td>
                                <a href="{{route('Painel.Pedido.New.index',$item->id)}}" 
                                    type="button" class="btn btn-success btn-sm"
                                     title="Fazer Pedido" > 
                                     <i class="fa-solid fa-cart-shopping nav-icon"></i> </a>
                            </td>
                        </tr>

                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Código Produto</th>
                            <th>Nome</th>
                            <th>Ação</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    
    </div>

</section>
<!-- /.content -->

@endsection
