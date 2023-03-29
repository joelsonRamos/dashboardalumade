@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                    data-target="#newetapa"><i class="fas fa-plus"></i> Adicionar Etapa</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">

                {{-- TABELA ETAPAS --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="">{{$urlAtual}}</h5>
                        <a href="{{route('Painel.index')}}" class="btn btn-success btn-sm"
                            title="Retornar Painel" >
                        <i class="fas fa-home nav-icon"></i>
                        Voltar</a> 
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Etapa</th>
                                    <th>Produto</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($etapa as $item)
                                @if ($item->deletado == 0)
                                    
                               
                                <tr>
                                    
                                    
                                    
                                    <td>{{$item->nome_etapa}}</td>
                                    <td>{{$item->name}}</td>
                                    
                                    <td>
                                        @if ($item->status == 1 )
                                        <span class="badge bg-success">Habilitado</span>
                                        @else
                                        <span class="badge bg-danger">Desabilitado</span>
                                        @endif

                                    </td>
                                    <td>

                                            <button id="btnGroupProduto" title="Opções"  class="btn btn-warning m-1 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical nav-icon"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupProduto">
                                                <button class="dropdown-item"
                                                id="editarEtapa"
                                                data-mytitle="{{$item->nome_etapa}}"
                                                data-myidproduto="{{$item->id_produto}}"
                                                data-nomeprodutos="{{$item->name}}"
                                                data-mystatus="{{$item->status}}"
                                                data-etapaid="{{$item->id}}"
                                                data-produto="{{$produto}}"
                                                data-toggle="modal" data-target="#editetapa">
                                                <i class="fa-solid fa-edit nav-icon"></i> Editar 
                                                </button>

                                                <button class="dropdown-item"
                                                id="excluirEtapa"
                                                data-myetapa="{{$item->nome_etapa}}"
                                                data-etapaid="{{$item->id}}"
                                                data-deletado="{{$item->deletado}}"
                                                data-toggle="modal" data-target="#deleteEtapa">
                                                <i class="fa-solid fa-trash nav-icon"></i> Excluir 
                                                </button>

                                                <hr>
                                                <a class="dropdown-item"
                                                    href="{{route('Painel.Item.index',$item->id)}}"
                                                    >
                                                    <i class="fa-solid fa-clone nav-icon"></i> Duplicar 
                                                </a>
                                            
                                            </div>

                                    </td>
                                </tr>
                                @endif
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Etapa</th>
                                    <th>Produto</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>


        {{-- MODAL PARA CRIAR UMA ETAPA --}}
        <div class="modal fade" id="newetapa">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nova Etapa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Painel.Etapa.store')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}
                        <input type="hidden" value="0" name="deletado" >
                        <input type="hidden" value="{{$userId}}" name="user" >
                        <div class="modal-body">
                            @include('Painel.Etapa.form')

                            <div class="form-group">
                                <label>Vincular a Produtos</label>
                                <select class="select2 " name="id_produto"  style="width: 100%;"  required>
                                    <option value="" selected disabled>Escolha um Produto</option>
                                    @foreach ($produto as $item)
                                        @if ($item->status == 1 && $item->deletado == 0)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-12 col-sm-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_novo"
                                            name="status" disabled checked>
                                        <label class="custom-control-label" for="status_novo">Estado</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                        </div>

                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->



        {{-- MODAL PARA EDITAR UMA ETAPA --}}
        <div class="modal fade" id="editetapa">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Etapa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Painel.Etapa.update')}}" method="POST" class="form-horizontal">
                        {{method_field('PUT')}}
                        {{ csrf_field()}}
                        <div class="modal-body">
                            @include('Painel.Etapa.form')
                            <input type="hidden" name="etapa_id" id="id" >
                            <input type="hidden" value="{{$userId}}" name="user" >

                            <div class="form-group row">
                                <div class="offset-sm-12 col-sm-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_edit_Etapa"
                                            name="status" >
                                        <label class="custom-control-label" for="status_edit_Etapa">Estado</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Vincular a Produtos</label>
                                <select class="select2 " name="id_produto" id="selectProduto"  style="width: 100%;" data-placeholder="Select a State" required>
                                    <option value="" selected disabled>Escolha um Produto</option>
                                </select>
                            </div>

                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-sm">Salvar Etapa</button>
                        </div>

                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        {{-- MODAL PARA DELETAR O PRODUTO --}}
        <div class="modal fade" id="deleteEtapa">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title " >Apagar</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <form action="{{route('Painel.Etapa.destroy')}}" method="POST" class="form-horizontal">
                        {{method_field('delete')}}
                        {{ csrf_field()}}
                        <div class="modal-body">
                            
                            <p>
                                Tem a certeza que pretende Excluir: 
                            </p>
                            <ul><li><span style="font-weight: bold " class="valueEtapa"></span></li></ul>
                            <p class="mt-2">
                                Irá apagar o Campo relacionado a esta Etapa
                            </p>
                            <input type="hidden" name="etapa_id" id="id_delete" value="" >
                            <input type="hidden" name="deletado" id="deletado" value="" >
                            <input type="hidden" value="{{$userId}}" name="user" >

                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-warning">Sim</button>
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
