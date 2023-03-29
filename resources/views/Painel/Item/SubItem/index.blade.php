@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                    data-target="#newsubitem" title="Adicionar"><i class="fas fa-plus"></i> Add Sub-Item</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">

                {{-- TABELA CAMPO --}}
                <div class="card">
                    <div class="card-header">
                        @foreach ($nome_item as $valor)
                            <h5 class="">Grupo Campo / Sub-Grupo / {{$valor->name_item}}</h5>
                            <a href="{{route('Painel.Item.index',$valor->id_campo)}}" class="btn btn-success btn-sm"
                                title="Retornar Item">
                                <i class="fas fa-chart-simple nav-icon"></i>
                                Voltar</a>
                        @endforeach

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table  table-bordered table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Nome</th>
                                    <th>Imagem</th>
                                    <th>Estado</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($subitem as $item)
                                
                                    <tr>
                                        
                                        <td>{{$item->nome_lista}}</td>
                                        <td>
                                            @if ($item->image != '')
                                                @php
                                                    $comeca ='#';
                                                    $existe = (strpos($item->image,$comeca) !== false);
                                                @endphp
                                                @if ($existe)
                                                    <div style="
                                                    width: 2.5rem;
                                                    height: 2.5rem;
                                                    border-radius: 50%;
                                                    background-color: {{$item->image}}
                                                    "></div>
                                               @else
                                                <img class="img-responsive "
                                                src="{{asset('AdminLTE/dist/img/listas/'.$item->image)}}" 
                                                width="80"
                                                height="80">
                                               @endif

                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1 )
                                                <span class="badge bg-success">Habilitado</span>
                                            @else
                                                <span class="badge bg-danger">Desabilitado</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button id="btnGroupSubItem" title="Relacionamento"  class="btn btn-warning m-1 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical nav-icon"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupSubItem">
                                                <button class="dropdown-item"
                                                id="editarSubItem"
                                                data-mytitle="{{$item->nome_lista}}" 
                                                data-mystatus="{{$item->status}}"
                                                data-myimg="{{$item->image}}"
                                                data-subetapaid="{{$item->id}}"
                                                data-tipoacao="{{$item->tipo_acao}}"
                                                data-myacao="{{$item->acao}}"
                                                data-toggle="modal" title="Editar"
                                                data-target="#editsubitem">
                                                <i class="fa-solid fa-edit nav-icon"></i> Editar 
                                                </button>

                                                <button class="dropdown-item"
                                                id="excluirSubItem"
                                                data-myproduto="{{$item->nome_etapa}}"
                                                data-prodid="{{$item->id}}"
                                                data-toggle="modal" data-target="#deleteSubItem">
                                                <i class="fa-solid fa-trash nav-icon"></i> Excluir 
                                                </button>
                                            
                                            </div>
                                            {{-- <button class="btn btn-warning fas fa-edit m-2 btn-sm"
                                                data-mytitle="{{$item->nome_lista}}" 
                                                data-mystatus="{{$item->status}}"
                                                data-myimg="{{$item->image}}"
                                                data-subetapaid="{{$item->id}}"
                                                data-tipoacao="{{$item->tipo_acao}}"
                                                data-myacao="{{$item->acao}}"
                                                data-toggle="modal" title="Editar"
                                                data-target="#editsubitem">
                                            </button> --}}
                                        </td>
                                    </tr>
                                    {{-- @endif --}}
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    
                                    <th>Nome</th>
                                    <th>Imagem</th>
                                    <th>Estado</th>
                                    <th>Ação</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PARA CRIAR SUB-ITEM --}}
    <div class="modal fade" id="newsubitem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Novo Sub-Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="sub_itens" action="{{route('Painel.Item.storesub' )}}" method="POST" class="form-horizontal"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <input type="hidden" name="id_item" id="id" value="{{$id_item}}">
                        @include('Painel.Item.SubItem.form')
                        <div class="form-group row">
                            <div class="offset-sm-12 col-sm-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status_novo" name="status"
                                        disabled checked>
                                    <label class="custom-control-label" for="status_novo">Estado</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row ">
                                <div class="col-12 mb-2">
                                    <strong >Escolher</strong>
                                </div>
                                <div class="custom-control custom-radio ml-2 col-sm-4 text-center">
                                    <input class="custom-control-input radio"  type="radio" id="cor_radio" name="escolher">
                                    <label for="cor_radio" class="custom-control-label">Cor</label>
                                </div>
                                <div class="custom-control custom-radio ml-2 col-sm-4">
                                    <input class="custom-control-input" type="radio" id="imagem_radio" name="escolher">
                                    <label for="imagem_radio" class="custom-control-label">Imagem</label>
                                </div>

                        </div>
                        <div class="form-group row" id="exibe_image" style="display: none">
                            <div class="col-sm-12">
                                <label for="image">Imagem</label>
                                <input type="file" class="form-control-file" value="" id="image" name="image"
                                    data-browse-on-zone-click="true">

                            </div>
                        </div>
                        <div class="form-group row" id="exibe_cor" style="display: none">
                            <div class="col-sm-4">
                                <label for="image">Cor</label>
                                <input type="color" class="form-control-file "  id="cor_escolher" name="image"
                                    data-browse-on-zone-click="true" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ação</label>
                            <select class="form-control select2 " name="tipo_acao" id="item_subitem"  style="width: 100%;" required>
                                <option value="">selecione Ação</option>
                                <option value="semacao">Sem Ação</option>
                                <option value="medidas">Medidas (limites visibilidade)</option>
                                <option value="desc">Desconto em %</option>
                                <option value="add">Acrescimo em %</option>
                            </select>
                        </div>
                        <div id="limite-subitem" style="display: none">
                            <div class="form-group row"  >
                                <div class="offset-sm-12 col-sm-6" id="minimoDiv">
                                    <label for="nome">Limite (Mínimo)</label>
                                    <input type="number" class="form-control" id="minimo_sub" min="0" >
                                </div>
                                <div class="offset-sm-12 col-sm-6" id="maximoDiv">
                                    <label for="nome">Limite (Máximo)</label>
                                    <input type="number" class="form-control" id="maximo_sub" min="0" >
                                </div>
                                <input type="hidden" id="calculo" value="">
                            </div>
                        </div>
                        <div class="form-group" id="operacao-subitem" style="display: none">
                            <label for="operacao" id='texto_relacao'> </label>
                            <select id="operacao"  class="form-control select2bs4" style="width: 100%;">
                                <option value="">Selecione Operação</option>
                                <option value="soma">Soma</option>
                                <option value="subtracao">Subtração</option>
                            </select>
                        </div>
                        <div class="form-group row" id="desconto" style="display: none">
                            <div class="offset-sm-12 col-sm-6">
                                <label for="nome">Porcentagem</label>
                                <input type="number" class="form-control" id="percent_desconto" min="0" max="70">
                            </div>
                        </div>
                        <div class="form-group row" id="acrescimo" style="display: none">
                            <div class="offset-sm-12 col-sm-6">
                                <label for="nome">Porcentagem</label>
                                <input type="number" class="form-control" id="percent_acrescimo" min="0" max="70">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    {{-- MODAL PARA EDITAR LISTA--}}
    <div class="modal fade" id="editsubitem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Sub-Item</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('Painel.Item.updatesub',$id_item )}}" method="POST" class="form-horizontal"
                enctype="multipart/form-data">
                    {{method_field('PUT')}}
                    {{ csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        @include('Painel.Item.SubItem.form')
                        <div class="form-group row">
                            <div class="offset-sm-12 col-sm-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status_edit_lista"
                                        name="status">
                                    <label class="custom-control-label" for="status_edit_lista">Estado</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="exibe_image_edit" style="display: none">
                            <div class="col-sm-12">
                                <label for="image_edit">Imagem</label>
                                <input type="file" class="form-control-file" value="" id="image_edit" name="image"
                                    data-browse-on-zone-click="true">
    
                            </div>
                        </div>
                        <div class="" id="imageDiv">
                            
                        </div>
                        <div class="form-group row" id="exibe_cor_edit" style="display: none">
                            <div class="col-sm-4">
                                <label for="cor_escolher_edit">Cor</label>
                                <input type="color" class="form-control-file" id="cor_escolher_edit" name="image"
                                    data-browse-on-zone-click="true" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Ação</label>
                            <select class="form-control select2 " name="tipo_acao" id="item_subitem_edit"  style="width: 100%;" required>
                                <option value="">selecione Ação</option>
                                <option value="semacao">Sem Ação</option>
                                <option value="medidas">Medidas (limites visibilidade)</option>
                                <option value="desc">Desconto em %</option>
                                <option value="add">Acrescimo em %</option>
                            </select>
                        </div>
                        <div id="limite-subitem_edit" style="display: none">
                            <div class="form-group row"  >
                                <div class="offset-sm-12 col-sm-6" id="minimoDiv_edit">
                                    <label for="nome">Limite (Mínimo)</label>
                                    <input type="number" class="form-control" id="minimo_sub_edit" min="0" >
                                </div>
                                <div class="offset-sm-12 col-sm-6" id="maximoDiv">
                                    <label for="nome">Limite (Máximo)</label>
                                    <input type="number" class="form-control" id="maximo_sub_edit" min="0" >
                                </div>
                                <input type="hidden" id="calculo_edit" value="">
                            </div>
                        </div>
                        <div class="form-group row" id="desconto_edit" style="display: none">
                            <div class="offset-sm-12 col-sm-6">
                                <label for="nome">Porcentagem</label>
                                <input type="number" class="form-control" id="percent_desconto_edit" min="0" max="70">
                            </div>
                        </div>
                        <div class="form-group row" id="acrescimo_edit" style="display: none">
                            <div class="offset-sm-12 col-sm-6">
                                <label for="nome">Porcentagem</label>
                                <input type="number" class="form-control" id="percent_acrescimo_edit" min="0" max="70">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>
<!-- /.content -->

@endsection
