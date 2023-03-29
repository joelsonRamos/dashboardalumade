@extends('Painel.layout.index')
@section('content')


<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#newitem"
                    title="Adicionar"><i class="fas fa-plus"></i> Adicionar Variável</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                {{-- TABELA CAMPO --}}
                <div class="card">
                    <div class="card-header">
                        @foreach ($campo as $valor)
                                <h5 class="">Campo / {{$valor->name_campo}}</h5>
                                <a href="{{route('Painel.Campo.index')}}" class="btn btn-success btn-sm" 
                                    title="Retornar Campos" >
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
                                    <th>Tipo</th>
                                    <th>Visivel</th>
                                    <th>Estado</th>
                                    <th>Ação</th>
                    campo            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($item as $chave=> $item)
                                <tr>
                                    <td>{{$item->name_item}}<br>
                                        @if( $item->tipo_item == 'number')
                                            @foreach($itemid as $i)
                                                @if ($i->id == $item->id)
                                                (min: {{$i->limite_min}} - max: {{$i->limite_max}})
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @switch($item->tipo_item)
                                            @case('number')
                                                Número                                                
                                                @break
                                            @case('radio')
                                                Radio
                                                @break
                                            @case('checkbox')
                                                Checkbox
                                                @break
                                            @case('lista_select')
                                                Lista - Select
                                                @break
                                            @case('lista_grade')
                                                Lista - Grade
                                                @break
                                            @case('date')
                                                Data
                                                @break
                                            @case('switch')
                                                switch
                                                @break
                                            @default
                                            
                                        @endswitch

                                    </td>
                                    <td>
                                        @switch($item->visivel_em)
                                            @case('orcamento')
                                                Não visível na criação de uma variável
                                                @break
                                            @case('resumo')
                                                Não visível na Pré-Visualização
                                                @break
                                            @case('todos')
                                                Visível para todos
                                                @break
                                            @default
                                            
                                        @endswitch
                                    </td>
                                    <td>
                                        @if ($item->status == 1 )
                                        <span class="badge bg-success">Habilitado</span>
                                        @elseif($item->status == 0)
                                        <span class="badge bg-danger">Desabilitado</span>
                                        @endif
                                    </td>
                                    <td >
                                        <button id="btnGroupProduto" title="opções"  class="btn btn-warning m-1 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical nav-icon"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupProduto">
                                            
                                            <button class="dropdown-item"
                                            id="editarItem"
                                            data-mytitle="{{$item->name_item}}"
                                            data-mytipo="{{$item->tipo_item}}"
                                            data-visivel="{{$item->visivel_em}}"
                                            data-mystatus="{{$item->status}}"
                                            data-idnumber ="{{$itemid}}"
                                            data-etapaid="{{$item->id}}"
                                            data-switch="{{$idswitch}}"
                                            data-toggle="modal" title="Editar " data-target="#edititem">
                                            <i class="fa-solid fa-edit nav-icon"></i> Editar 
                                            </button>
                                            <button class="dropdown-item"
                                                    id="excluirItem"
                                                    data-myproduto="{{$item->name_item}}"
                                                    data-prodid="{{$item->id}}"
                                                    data-toggle="modal" data-target="#deleteItem">
                                                    <i class="fa-solid fa-trash nav-icon"></i> Excluir 
                                            </button>
                                            <button class="dropdown-item"
                                                id="DuplicarItem"
                                                data-itemid="{{$item->id}}"
                                                data-campoid="{{$id_campo}}"
                                                data-toggle="modal"
                                                title="duplicar "
                                                data-target="#duplicar">
                                                <i class="fa-solid fa-clone nav-icon"></i> Duplicar 
                                            </button>
                                            
                                            @if ($item->tipo_item == 'lista_select' || $item->tipo_item == 'lista_grade')
                                            <hr/>
                                            <a href="{{route('Painel.Item.sub-item.storesub',$item->id)}}"
                                                class="dropdown-item">
                                                <i class="fa-solid fa-plus nav-icon"></i> Adicionar Lista
                                            </a>

                                                
                                            @endif
                                        </div>

                                        {{-- <button  class="btn btn-warning m-1 btn-sm" 
                                            data-mytitle="{{$item->name_item}}"
                                            data-myname="{{$item->placeholder}}"
                                            data-mytipo="{{$item->tipo_item}}"
                                            data-mystatus="{{$item->status}}"
                                            data-myminimo="{{$item->limite_min}}"
                                            data-mymaximo="{{$item->limite_max}}"
                                            data-etapaid="{{$item->id}}"
                                            data-toggle="modal" title="Editar " data-target="#edititem" >
                                            <i class="fa-solid fa-edit nav-icon"></i>
                                        </button>

                                        @if ($item->tipo_item == 'select') 
                                            <a href="{{route('Painel.Item.sub-item.storesub',$item->id)}}"
                                                class="btn btn-success m-1 btn-sm">
                                                <i class="fa-solid fa-plus nav-icon"></i>
                                            </a>
                                            <button  class="btn btn-secondary m-1 btn-sm"
                                                data-itemid="{{$item->id}}"
                                                data-campoid="{{$id_campo}}"
                                                data-toggle="modal"
                                                title="duplicar "
                                                data-target="#duplicar">
                                                <i class="fa-solid fa-clone nav-icon"></i>
                                            </button>
                                        @endif --}}
                                    </td>
                                </tr>
                                {{-- @endif --}}
                               
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Tipo</th>
                                    <th>Visivel</th>
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
    

        {{-- MODAL PARA DUPLICAR --}}
        <div class="modal fade" id="duplicar">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Duplicar lista</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Painel.Item.updateduplica', $id_campo)}}" method="POST" class="form-horizontal">
                        {{method_field('PUT')}}
                        {{ csrf_field()}}
                        <div class="modal-body">
                            <input type="hidden" name="id_items" id="id"  >
                            {{-- @include('Painel.Item.form') --}}
                            <!-- checkbox -->
                            <label>Duplicar Para</label>
                            <div class="form-group ">
                                <div class="row">
                                    @foreach ($campo as $item)
                                        @if ($item->status == 1)
                                                <div class="col-4">
                                                    <div class="icheck-primary ">
                                                        <input 
                                                            class="duplica" type="checkbox" 
                                                            value="{{$item->id}}"  
                                                            name="id_campo[{{$item->id}}]" 
                                                            id="campo_{{$item->id}}">
                                                        <label for="campo_{{$item->id}}">
                                                        {{$item->name_campo}}
                                                        </label>
                                                    </div>
                                                </div>
                                        @endif
                                    @endforeach
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

    {{-- MODAL PARA CRIAR UM ITEM --}}
    <div class="modal fade" id="newitem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Criar Variável</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('Painel.Item.store','teste' )}}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <input type="hidden" value="0" name="deletado" >
                    <input type="hidden" value="{{$userId}}" name="user" >
                    <div class="modal-body">
                        <input type="hidden" name="id_campo" id="id" value="{{$id_campo}}" >
                        <div class="form-group">
                            <label>Tipo da Variável</label>
                            <select class="form-control select2 " name="tipo_item" id="item_novo"  style="width: 100%;" required>
                                <option value="" selected disabled>selecione o tipo</option>
                                <option value="checkbox">Checkbox</option>
                                <option value="radio">Radio</option>
                                <option value="number">Número</option>
                                <option value="select">Lista</option>
                                <option value="date">Data</option>
                                <option value="switch">Switch</option>
                            </select>
                        </div>
                        @include('Painel.Item.form')
                        <div class="form-group row " id="auxiliar-novo" style="display: none">
                            <div class="offset-sm-12 col-sm-12">
                                <label for="nome">Texto Auxiliar (placeholder)</label>
                                <input type="text" class="form-control" id="placeholder" name="placeholder">
                            </div>
                        </div>
                        <div class="form-group modovisualizacaoLista" id="modo_novo" style="display: none">
                            <label for="nome">Modo de visualização</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="icheck-primary">
                                        <input type="radio" name="visualizacao" checked id="select" value="lista_select">
                                        <label for="select">
                                            Modo Select
                                        </label>
                                        <i class="fa-solid fa-caret-down"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="icheck-primary">
                                        <input type="radio" name="visualizacao"  id="grade" value="lista_grade">
                                        <label for="grade">
                                            Modo Grade
                                            
                                        </label>
                                        <i class="fa-solid fa-grip nav-icon"></i>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id='switch-novo' style="display: none">
                            <div class="row">
                                <div class=" col-6" >
                                    <label for="nome">Alternativa 1</label>
                                    <input type="text" class="form-control" id="alternativa_um" min="0" name="alternativa_um">
                                </div>
                                <div class=" col-6" >
                                    <label for="nome">Alternativa 2</label>
                                    <input type="text" class="form-control" id="alternativa_dois" min="0" name="alternativa_dois">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="form-group" id="limite-novo" style="display: none">
                            <div class="row">
                                <div class=" col-6" id="minimoDiv">
                                    <label for="nome">Limite (Mínimo)</label>
                                    <input type="number" class="form-control" id="minimo" min="0" name="limite_min">
                                </div>
                                <div class=" col-6" id="maximoDiv">
                                    <label for="nome">Limite (Máximo)</label>
                                    <input type="number" class="form-control" id="maximo" min="0" name="limite_max">
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-12 col-sm-12">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status_novo"
                                        name="status" value="1" disabled checked>
                                    <label class="custom-control-label" for="status_novo">Estado</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-12 col-sm-12">
                                <div class="icheck-primary ">
                                    <input type="radio" name="visivel_em" checked id="todos" value="todos">
                                    <label for="todos">
                                        Visível em todos
                                    </label>
                                </div>
                                <div class="icheck-primary ">
                                    <input type="radio" name="visivel_em"  id="orcamento" value="orcamento">
                                    <label for="orcamento">
                                        Não visível na criação de uma variável
                                    </label>
                                </div>
                                <div class="icheck-primary ">
                                    <input type="radio" name="visivel_em"  id="resumo" value="resumo">
                                    <label for="resumo">
                                        Não visível na Pré-Visualização
                                    </label>
                                </div>
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

    {{-- MODAL PARA EDITAR UM ITEM --}}
    <div class="modal fade" id="edititem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Variável</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('Painel.Item.update' )}}" method="POST" class="form-horizontal">
                    {{method_field('PUT')}}
                        {{ csrf_field()}}
                        <input type="hidden" value="0" name="deletado" >
                        <input type="hidden" value="{{$userId}}" name="user" >
                        <div class="modal-body">
                            <input type="hidden" name="id_item" id="edit_id_item" value="" >
                            <input type="hidden" name="id_campo" id="edit_id" value="{{$id_campo}}" >
                            <div class="form-group">
                                <label>Tipo da Variável</label>
                                <select class="form-control select2 " name="tipo_item" id="item_edit"  style="width: 100%;" required>
                                    <option value="" selected disabled>selecione o tipo</option>
                                    <option value="checkbox">Checkbox</option>
                                    <option value="radio">Radio</option>
                                    <option value="number">Número</option>
                                    <option value="select">Lista</option>
                                    <option value="date">Data</option>
                                    <option value="switch">Switch</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label for="nome">Nome da Variável</label>
                                    <input type="text" class="form-control" id="edit-name_item" name="name_item" placeholder=""
                                        required>
                                </div>
                            </div>
                            <div class="form-group row " id="auxiliar-edit" style="display: none">
                                <div class="offset-sm-12 col-sm-12">
                                    <label for="nome">Texto Auxiliar (placeholder)</label>
                                    <input type="text" class="form-control" id="placeholder-edit" name="placeholder">
                                </div>
                            </div>
                            <div class="form-group modovisualizacaoLista" id="modo_edit" style="display: none">
                                <label for="nome">Modo de visualização</label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="icheck-primary">
                                            <input type="radio" name="visualizacaoedit" id="select-edit" value="lista_select">
                                            <label for="select-edit">
                                                Modo Select
                                            </label>
                                            <i class="fa-solid fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="icheck-primary">
                                            <input type="radio" name="visualizacaoedit"  id="grade-edit" value="lista_grade">
                                            <label for="grade-edit">
                                                Modo Grade
                                                
                                            </label>
                                            <i class="fa-solid fa-grip nav-icon"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id='switch-edit' style="display: none">
                                <div class="row">
                                    <div class=" col-6" >
                                        <label for="nome">Alternativa 1</label>
                                        <input type="text" class="form-control" id="edit-alternativa_um" min="0" name="alternativa_um">
                                    </div>
                                    <div class=" col-6" >
                                        <label for="nome">Alternativa 2</label>
                                        <input type="text" class="form-control" id="edit-alternativa_dois" min="0" name="alternativa_dois">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group" id="limite-edit" style="display: none">
                                <div class="row">
                                    <div class=" col-6" id="edit-minimoDiv">
                                        <label for="nome">Limite (Mínimo)</label>
                                        <input type="number" class="form-control" id="edit-minimo" min="0" name="limite_min">
                                    </div>
                                    <div class=" col-6" id="edit-maximoDiv">
                                        <label for="nome">Limite (Máximo)</label>
                                        <input type="number" class="form-control" id="edit-maximo" min="0" name="limite_max">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-12 col-sm-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_edit_variavel"
                                            name="status" >
                                        <label class="custom-control-label" for="status_edit_variavel">Estado</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-12 col-sm-12">
                                    <div class="icheck-primary ">
                                        <input type="radio" name="visivel_em" checked id="todos" value="todos">
                                        <label for="todos">
                                            Visível em todos
                                        </label>
                                    </div>
                                    <div class="icheck-primary ">
                                        <input type="radio" name="visivel_em"  id="orcamento" value="orcamento">
                                        <label for="orcamento">
                                            Não visível na criação de uma variável
                                        </label>
                                    </div>
                                    <div class="icheck-primary ">
                                        <input type="radio" name="visivel_em"  id="resumo" value="resumo">
                                        <label for="resumo">
                                            Não visível na Pré-Visualização
                                        </label>
                                    </div>
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
