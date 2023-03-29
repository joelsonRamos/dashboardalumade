@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                    data-target="#newSetor" title="Adicionar"><i class="fas fa-plus"></i> Add Setor</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                {{-- TABELA CAMPO --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class=""> {{$urlAtual}} </h5>
                        <a href="{{route('Painel.index')}}" 
                            class="btn btn-success btn-sm"
                            title="Retornar Painel" >
                            <i class="fas fa-home nav-icon"></i>
                            Voltar
                        </a> 
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Setor</th>
                                    <th>Responsaveis</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($setor as $key=>$item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name_setor}}</td>
                                   <td>{{$item->nome_responsaveis}}</td>
                                    <td>
                                        <button  class="btn btn-warning  m-1 btn-sm"
                                            data-myid="{{$item->id}}"
                                            data-mysetor="{{$item->name_setor}}"
                                            data-toggle="modal" title="Editar Setor " data-target="#editSetor" >
                                            <i class="fa-solid fa-edit nav-icon"></i>
                                        </button>
                                        <button id="btnGroupDrop1" title="Relacionamento"  class="btn btn-success m-1 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical nav-icon"></i>
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            @php
                                                $cont = 0;
                                            @endphp
                                            @foreach ($setor_campo as $itemsetorcampo)
                                                @if ($itemsetorcampo->id_setor == $item->id)
                                                @php
                                                    $cont ++;
                                                @endphp
                                                @endif
                                            @endforeach
                                            @if ($cont == 0)
                                                <a class="dropdown-item"
                                                id="relacionar"
                                                data-myid="{{$item->id}}"
                                                data-mysetor="{{$item->name_setor}}"
                                                data-responsavel="{{$item->responsaveis}}"
                                                data-mysetorcampo="{{$setor_campo}}"
                                                data-toggle="modal" title="Relacionar" data-target="#relecionar" >
                                                Relacionar
                                                </a>
                                            @else
                                                <a class="dropdown-item"
                                                data-myid="{{$item->id}}"
                                                data-mysetor="{{$item->name_setor}}"
                                                data-mysetorcampo="{{$setor_campo}}"
                                                data-responsavel="{{$item->responsaveis}}"
                                                data-mycampo="{{$campos_all}}"
                                                data-toggle="modal"  
                                                data-target="#editar_relecionar">
                                                Editar
                                                </a>
                                            @endif
                                            
                                        </div>
                                        
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Código </th>
                                    <th>Setor</th>
                                    <th>Responsaveis</th>
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

            {{-- MODAL PARA CRIAR UM SETOR --}}
            <div class="modal fade" id="newSetor">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Novo Setor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Painel.Setores.store')}}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group row">
                                    {{-- <input type="hidden" name="id" id="id_user" > --}}
                                    <div class="col-sm-12">
                                        <label for="user">Nome Setor</label>
                                        <input type="text" class="form-control" id="edit_name_setor" name="name_setor" 
                                        required>
                                    </div>
                                </div>
                                <div class="form-group" id="div_responsavel">
                                    <label for="responsavel">Responsavel do Setor</label>
                                    <select
                                        multiple="multiple"
                                        id="responsavel" 
                                        name="responsaveis[]" 
                                        class="form-control select3"
                                        multiple="multiple"
                                        data-placeholder="Relacione Campo"
                                        style="width: 100%;">
                                        @foreach ($operadores as $operador)
                                        <option value="{{$operador->id}}">{{$operador->name}}</option>
                                        @endforeach
                                    </select>
                                    
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

            {{-- MODAL PARA EDITAR SETOR --}}
            <div class="modal fade" id="editSetor">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Setor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Painel.Setores.update')}}" method="POST" class="form-horizontal">
                            {{method_field('PUT')}}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group row">
                                    <input type="hidden" name="id" id="id_user" >
                                    <div class="col-sm-12">
                                        <label for="user">Nome Setor</label>
                                        <input type="text" class="form-control" id="name_setor" name="name_setor" 
                                        required>
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
            {{-- MODAL PARA Relacionar SETOR --}}
            <div class="modal fade" id="relecionar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Relacionar Setor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Painel.Setores.create','relacionamento')}}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="form-group row">
                                    <input type="hidden" name="id_setor" id="id_setor" >
                                    <div class="col-sm-12">
                                        <label for="user">Nome Setor</label>
                                        <input type="text" class="form-control" id="relacao_setor" name="name_setor"
                                        readonly 
                                        required>
                                    </div>
                                </div>
                                <div class="form-group" id="div_campos" >
                                                                        
                                    <label for="setor_campo">Campo</label>
                                    <select 
                                        id="setor_campo" 
                                        name="id_campo[]" 
                                        class="form-control select3"
                                        multiple="multiple"
                                        data-placeholder="Relacione Campo"
                                        style="width: 100%;">
                                        @foreach ($campos as $campo)
                                        <option value="{{$campo->id}}">{{$campo->name_campo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="div_responsavel_relacionar">
                                    <label for="responsavel_relacionar">Responsável do Setor</label>
                                    <select
                                        multiple="multiple"
                                        id="responsavel_relacionar" 
                                        name="responsavel[]" 
                                        class="form-control select3"
                                        multiple="multiple"
                                        data-placeholder="Relacione Campo"
                                        style="width: 100%;">
                                        @foreach ($operadores as $operador)
                                        <option value="{{$operador->id}}">{{$operador->name}}</option>
                                        @endforeach
                                    </select>
                                    
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
            {{-- MODAL PARA EDITAR Relacionar SETOR --}}
            <div class="modal fade" id="editar_relecionar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Relacionamento do Setor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Painel.Setores.updaterel','id')}}" method="POST" class="form-horizontal">
                            {{method_field('PUT')}}
                            {{ csrf_field()}}
                            
                            <div class="modal-body">
                                <div class="form-group row">
                                    <input type="hidden" name="id" id="id_setor_campo_ID" >
                                    <input type="hidden" name="id_setor" id="id_setor_campo" >
                                    <div class="col-sm-12">
                                        <label for="user">Nome Setor</label>
                                        <input type="text" class="form-control" id="edit_relacao_setor" name=""
                                        readonly 
                                        required>
                                    </div>
                                </div>
                                <div class="form-group" id="div_campos2">
                                    <label for="edit_setor_campo">Campo</label>
                                    <select
                                        multiple="multiple"
                                        id="edit_setor_campo" 
                                        name="id_campo[]"
                                        class="form-control select3"
                                        data-placeholder="Relacione Campo"
                                        style="width: 100%;">
                                        @foreach ($campos_all as $campo)
                                        <option value="{{$campo->id}}">{{$campo->name_campo}}</option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="form-group" id="div_responsavel_edit">
                                    <label for="edit_relacionamento_responsavel">Responsável do Setor</label>
                                    <select
                                        multiple="multiple"
                                        id="edit_relacionamento_responsavel" 
                                        name="responsaveis[]"
                                        class="form-control select3"
                                        data-placeholder="Relacione responsavel"
                                        style="width: 100%;">
                                        @foreach ($operadores as $operador)
                                        <option value="{{$operador->id}}">{{$operador->name}}</option>
                                        @endforeach
                                    </select>
                                    
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

</section>
<!-- /.content -->
@endsection
