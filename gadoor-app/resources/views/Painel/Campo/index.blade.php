@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                    data-target="#newCampo" 
                    data-myetapa="{{$etapa}}"
                    title="Adicionar"><i class="fas fa-plus"></i> Adicionar Campo</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                
                
                <div class="card">
                    <div class="card-header">
                        <h5 class=""> {{$urlAtual}} </h5>
                        <a href="{{route('Painel.index')}}" class="btn btn-success btn-sm"
                            title="Retornar Painel" >
                        <i class="fas fa-home nav-icon"></i>
                        Voltar</a> 
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {{-- TABELA CAMPO --}}
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Campo</th>
                                    <th>Etapa</th>
                                    <th>Produto</th>
                                    <th>Estado</th>
                                    <th>Variável</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($campo as $item)
                                @if ($item->deletado == 0)
                                
                                <tr>
                                    <td>{{$item->name_campo}}</td>
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
                                        <a class="btn  btn-warning btn-sm"
                                        href="{{route('Painel.Item.index',$item->id)}}"
                                        >
                                        <i class="fa-solid fa-plus nav-icon"></i> Adicionar 
                                        </a>
                                    </td>
                                    <td>
                                    
                                        <button id="btnGroupCampo" title="Opções"  class="btn btn-warning m-1 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical nav-icon"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupCampo">

                                                    <button class="dropdown-item"
                                                    id="editarCampo"
                                                    data-mytitle="{{$item->name_campo}}"
                                                    data-campoid="{{$item->id}}"
                                                    data-nomeetapa="{{$item->nome_etapa}}"
                                                    data-etapaid="{{$item->id_etapas}}"
                                                    data-myetapa="{{$etapa}}"
                                                    data-nomeproduto="{{$item->name}}"
                                                    data-idproduto="{{$item->id_produtos}}"
                                                    data-mystatus="{{$item->status}}"
                                                    
                                                    data-toggle="modal" title="Editar " data-target="#editcampo">
                                                    <i class="fa-solid fa-edit nav-icon"></i> Editar 
                                                    </button>
                                                    
                                                    <button class="dropdown-item"
                                                    id="excluirCampo"
                                                    data-mycampo="{{$item->name_campo}}"
                                                    data-campoid="{{$item->id}}"
                                                    data-deletado="{{$item->deletado}}"
                                                    data-toggle="modal" data-target="#deleteCampo">
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
                                    <th>Campo</th>
                                    <th>Etapa</th>
                                    <th>Produto</th>
                                    <th>Estado</th>
                                    <th>Variável</th>
                                    <th>Ação</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>


        {{-- MODAL PARA CRIAR UM CAMPO --}}
        <div class="modal fade" id="newCampo">
            <div class="modal-dialog">
              name_campo  <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Campo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Painel.Campo.store', 'teste')}}" method="POST" class="form-horizontal">
                        {{csrf_field() }}
                        <input type="hidden" value="0" name="deletado" >
                        <input type="hidden" value="{{$userId}}" name="user" >
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="nome">Nome Campo</label>
                                    <input type="text" class="form-control" id="name_campo" name="name_campo" placeholder="Campo"
                                        required>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label>Vincular a Etapa</label>
                                <select class="select2"  name="id_etapas" id="etapa_new"  style="width: 100%;" required>
                                    <option value="" selected disabled>Escolha uma etapa</option>
                                    @foreach ($etapa as $item)
                                        @if ($item->status == 1 && $item->deletado == 0 )
                                        <option value="{{$item->id}}">{{$item->nome_etapa}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="nome">Produto vinculado com a Etapa</label>
                                    <input type="text" class="form-control" id="nome_produto" name="" placeholder=""
                                    readonly  required >
                                    <input type="hidden" id="id_produto" name="id_produtos" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-12 col-sm-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_novo_campo"
                                            name="status" value="1" disabled checked>
                                        <label class="custom-control-label" for="status_novo_campo">Estado</label>
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



        {{-- MODAL PARA EDITAR CAMPO --}}
        <div class="modal fade" id="editcampo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Campo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Painel.Campo.update')}}" method="POST" class="form-horizontal">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                            
                            <input type="hidden" value="{{$userId}}" name="user" >
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="nome">Nome Campo</label>
                                    <input type="text" class="form-control" id="edit_name_campo" name="name_campo" placeholder="Campo"
                                        required>
                                </div>
                            </div>
                            <input type="hidden" name="id_campo" id="id">

                            <div class="form-group row">
                                <div class="offset-sm-12 col-sm-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_edit_campo"
                                            name="status" >
                                        <label class="custom-control-label" for="status_edit_campo">Estado</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Vincular a Etapa</label>
                                <select class="select2 "  name="id_etapas" id="edit_etapa"  style="width: 100%;" required>

                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="nome">Produto vinculado com a Etapa</label>
                                    <input type="text" class="form-control" id="edit_nome_produto" name="" placeholder=""
                                    readonly  required >
                                    <input type="hidden" id="edit_id_produto" name="id_produtos" >
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                        </div>

                    </form>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


                {{-- MODAL PARA DELETAR O CAMPO --}}
                <div class="modal fade" id="deleteCampo">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title " >Apagar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                            <form action="{{route('Painel.Campo.destroy')}}" method="POST" class="form-horizontal">
                                {{method_field('delete')}}
                                {{ csrf_field()}}
                                <div class="modal-body">
                                    
                                    <p>
                                        Tem a certeza que pretende Excluir: 
                                    </p>
                                    <ul><li><span style="font-weight: bold " class="valueCampo"></span></li></ul>
                                    <p class="mt-2">
                                        Irá apagar as Variáveis relacionado a este Campo
                                    </p>
                                    <input type="hidden" name="campo_id" id="id_delete" value="" >
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
