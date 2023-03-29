@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-12">

                {{-- TABELA Realizados --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pedidos Realizados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código Pedidos</th>
                                    <th>Nome</th>
                                    <th>status</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pedido as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name}}</td>

                                    <td>
                                        @if ($item->status == 0 )
                                        <span class="badge bg-danger">Cancelado</span>
                                        @elseif($item->status == 1)
                                        <span class="badge bg-primary">Solicitado</span>
                                        @elseif($item->status == 2)
                                        <span class="badge bg-success">Aprovado</span>
                                        @else
                                        <span class="badge bg-warning">Em Analise</span>
                                        @endif

                                    </td>
                                    
                                    <td>
                                        <button type="button" class="btn btn-warning m-1 btn-sm" data-toggle="modal"
                                        data-mystatus="{{$item->status}}"
                                        data-pedidoid="{{$item->id}}"    
                                        data-target="#editpedido" title="Editar ">
                                        <i class="fa-solid fa-edit nav-icon"></i>
                                    </button>
                                            
                                        <a href="{{route('Painel.Pedido.Visualizar.index',$item->id)}}"
                                            class="btn btn-danger m-1 btn-sm"
                                            title="visualizar Pedido " >
                                        <i class="fa-solid fa-glasses nav-icon"></i>
                                    </a>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Código Pedidos</th>
                                    <th>Nome</th>
                                    <th>status</th>
                                    <th>Ação</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>

                {{-- MODAL PARA EDITAR   --}}
                <div class="modal fade" id="editpedido">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mudar Estado</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('Painel.Pedido.update')}}" method="POST" class="form-horizontal">
                                {{method_field('PUT')}}
                                {{ csrf_field()}}
                                <div class="modal-body">
                                
                                    <input type="hidden" name="pedido_id" id="id" >
        
                                    <div class="form-group row">
                                        <div class="offset-sm-12 col-sm-12">
                                            <div class="form-group clearfix">
                                                <div class="icheck-success ">
                                                    <input class="status" type="radio" id="aprovado" name="status" value="2" >
                                                    <label class="mb-3 " for="aprovado">
                                                    Aprovado
                                                  </label>
                                                </div>
                                                <div class="icheck-warning ">
                                                    <input class="status" type="radio" id="analise" name="status" value="3" >
                                                  <label class="mb-3 " for="analise">
                                                    Em Analise
                                                  </label>
                                                </div>
                                                <div class="icheck-danger ">
                                                    <input class="status" type="radio" id="cancelado" name="status" value="0" >
                                                  <label for="cancelado">
                                                    Cancelado
                                                  </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- checkbox -->
                                </div>
        
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Mudar Estado</button>
                                </div>
        
                            </form>
        
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

    </div>

</section>
<!-- /.content -->

@endsection
