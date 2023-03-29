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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Permissão</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($users as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->name_user}}</td>
                                    <td>{{$item->name}}</td>                                    
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" 
                                            data-myname="{{$item->name}}"
                                            data-myuser="{{$item->name_user}}"
                                            data-myid="{{$item->id}}"
                                            data-toggle="modal" data-target="#editusario">
                                            <i class="fa-solid fa-edit nav-icon"></i></button>
                                        {{-- <button class="btn btn-danger fas fa-trash-can"
                                            data-prodid="{{$item->id}}"
                                            data-toggle="modal" data-target="#delete" ></button> --}}
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Código Produto</th>
                                    <th>Nome</th>
                                    <th>Permissão</th>
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
            {{-- MODAL PARA EDITAR --}}
            <div class="modal fade" id="editusario">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Usuário</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{route('Painel.Usuarios.update',)}}" method="POST"  class="form-horizontal">
                            {{method_field('PUT')}}
                            {{ csrf_field()}}
                            <div class="modal-body">
                                
                                <div class="form-group row">
                                    <input type="hidden" name="id" id="id_user" >
                                    <div class="col-sm-12">
                                        <label for="user">Nome Usuario</label>
                                        <input type="text" class="form-control" id="user" name="nome" 
                                        required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Permição</label>
                                    <select class="form-control select2 " name="name" id="permissao"  style="width: 100%;" required>
                                        <option value="">selecione permição</option>
                                        @foreach ($permicao as $item)
                                        <option value="{{$item->name}}">{{$item->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                    
                            </div>
    
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
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
