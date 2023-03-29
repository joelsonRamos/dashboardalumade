@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
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
                        <form action="{{route('Painel.Relacionamento.store', '1')}}" method="POST" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="row ">
                                <div class="col-sm-12 col-md-5">
                                    <div class="form-group">
                                        <h5 for="produto">Produtos</h5>
                                        <select id="produto" name="id_produto" class="form-control select2bs4" style="width: 100%;">
                                            <option value="">Selecione um produto</option>
                                                @foreach ( $produto as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class=" mt-4 col-sm-12 col-md-4">
                                    <label >Relacionar Operadores</label>
                                    <div>
                                        <a  class="btn btn-info btn-sm"
                                        data-toggle="modal"
                                        data-target="#relacionamento"> variáveis</a>
                                    </div>

                                </div>
                                <div class=" mt-4 col-sm-12 col-md-4">
                                    <label >Operadores</label>
                                    <div id="operadoresBtn" class="btn-toolbar" role="toolbar" aria-label="Toolbar com grupos de botões">
                                        <div class="btn-group" role="group" aria-label="Primeiro grupo">
                                            <button type="button" value="=" class="btn btn-info mr-2">=</button>
                                            <button type="button" value="+" class="btn btn-info mr-2">+</button>
                                            <button type="button" value="-" class="btn btn-info mr-2">-</button>
                                            <button type="button" value="*" class="btn btn-info mr-2">*</button>
                                            <button type="button" value="(" class="btn btn-info mr-2">(</button>
                                            <button type="button" value=")" class="btn btn-info mr-2">)</button>
                                        </div>
                                    </div>
                                    
                                </div>                                
                            </div>

                            <div class="mt-4 row">
                                <div class="col-sm-12 col-md-12 ">
                                    <input id="caixaOperadores" class="form-control activeInput" type="text" disabled>
                                    <span id="validate"></span>
                                </div>
                            </div>
                            <div class="mt-2 row justify-content-end ">
                                <div class="col-sm-12 col-md-6 d-flex justify-content-end align-items-end">
                                    <a class="btn btn-info btn-sm" id="limparRelacionar">Limpar</a>
                                    <a class="btn btn-info btn-sm ml-2" id="salvarRelacionamento">Salvar</a>
                                </div>
                            </div>
                        </form>
                        <div class="mt-4">
                            <hr>
                        </div>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Produto</th>
                                    <th>Nome Produto</th>
                                    <th>Variável</th>
                                    <th>Fórmula</th>
                                    {{-- <th>Ação</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($relacionamento as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->id_do_produto}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->nome_id_associacao}}</td>
                                    <td>{{$item->nome_formula_associacao}}</td>
                                    {{-- <td>
                                        <button type="button" class="btn btn-warning btn-sm" 
                                            data-mytitle=""
                                            data-myprice="" 
                                            data-mystatus=""
                                            data-prodid=""
                                            data-toggle="modal" data-target="#edit">
                                            <i class="fa-solid fa-edit nav-icon"></i></button>

                                    </td> --}}

                                    
                                </tr>
                                
                                {{-- @endforeach --}}

                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>id</th>
                                    <th>Produto</th>
                                    <th>Nome Produto</th>
                                    <th>Variável</th>
                                    <th>Fórmula</th>
                                    {{-- <th>Ação</th> --}}
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
                {{-- MODAL PARA VARAIAVEL --}}
    <div class="modal fade" id="relacionamento">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Relacionar variáveis</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <form class="form-horizontal">
                    <div class="modal-body">
                                    
                        <div class="form-group">
                            <label for="etapa">Etapa</label>
                            <select id="etapa" name="etapa_um" class="form-control select2bs4" style="width: 100%;">
                                <option>Selecione uma etapa</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="campo">Campo</label>
                            <select id="campo" name="campo_um" class="form-control select2bs4" style="width: 100%;">
                                <option>Selecione um campo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="variaveis">Grupo Variáveis</label>
                            <select id="variaveis" name="grupo_um" class="form-control select2bs4" style="width: 100%;">
                                <option value="">Selecione um elemento do grupo</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" id="limpar_variavel" class="btn btn-primary btn-sm" data-dismiss="modal">ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
