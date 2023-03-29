@extends('Painel.layout.index')
@section('content')
<script>
    String.prototype.reverse = function () {
        return this.split('').reverse().join('');
    };

    function mascaraMoeda(campo, evento) {
        var tecla = (!evento) ? window.event.keyCode : evento.which;
        var valor = campo.value.replace(/[^\d]+/gi, '').reverse();
        var resultado = "";
        var mascara = "##.###.###,##".reverse();
        for (var x = 0, y = 0; x < mascara.length && y < valor.length;) {
            if (mascara.charAt(x) != '#') {
                resultado += mascara.charAt(x);
                x++;
            } else {
                resultado += valor.charAt(y);
                y++;
                x++;
            }
        }
        campo.value = resultado.reverse();
    }

</script>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right btn-sm" data-toggle="modal"
                    data-target="#modal-default"><i class="fas fa-plus"></i> Adicionar Produto</button>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">

                {{-- TABELA PRODUTO --}}
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
                                    
                                    <th>Nome</th>
                                    <th>Estado</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($produto as $item)
                                @if ($item->deletado == 0)
                                    
                                
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        @if ($item->status == 1 )
                                        <span class="badge bg-success">Habilitado</span>
                                        @else
                                        <span class="badge bg-danger">Desabilitado</span>
                                        @endif

                                    </td>
                                    <td>
                                        

                                            <button id="btnGroupProduto" title="opções"  class="btn btn-warning m-1 btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis-vertical nav-icon"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupProduto">
                                                <button class="dropdown-item"
                                                id="editarProduto"
                                                data-mytitle="{{$item->name}}"
                                                data-myprice="{{$item->price}}" 
                                                data-mystatus="{{$item->status}}"
                                                data-prodid="{{$item->id}}"
                                                data-toggle="modal" data-target="#edit">
                                                <i class="fa-solid fa-edit nav-icon"></i> Editar 
                                                </button>

                                                <button class="dropdown-item"
                                                id="excluirProduto"
                                                data-myproduto="{{$item->name}}"
                                                data-prodid="{{$item->id}}"
                                                data-deletado ="{{$item->deletado}}"
                                                data-toggle="modal" data-target="#deleteProduto">
                                                <i class="fa-solid fa-trash nav-icon"></i> Apagar 
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
                                    
                                    <th>Nome</th>                      
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



        {{-- MODAL PARA EDITAR --}}
        <div class="modal fade" id="edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('Painel.Produto.update','test')}}" method="POST" class="form-horizontal">
                        {{method_field('PUT')}}
                        {{ csrf_field()}}
                        <div class="modal-body">
                            <input type="hidden" name="produto_id" id="id" >
                            <input type="hidden" value="{{$userId}}" name="user" >
                            
                            @include('Painel.Produto.form')

                            <div class="form-group row">
                                <div class="offset-sm-12 col-sm-12">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status_edit" 
                                        name="status"
                                        >
                                        <label class="custom-control-label" for="status_edit">Estado</label>
                                    </div>
                                </div>
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

                {{-- MODAL PARA CRIAR UM NOVO PRODUTO --}}
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Novo Produto</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{route('Painel.Produto.store')}}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <input type="hidden" value="0" name="deletado" >
                                    <input type="hidden" value="{{$userId}}" name="user" >
                                    @include('Painel.Produto.form')
                                    <div class="form-group row">
                                        <div class="offset-sm-12 col-sm-12">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="status_novo" name="status"
                                                    disabled checked>
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

                 {{-- MODAL PARA DELETAR O PRODUTO --}}
                 <div class="modal fade" id="deleteProduto">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title " >Apagar</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{-- <form action="{{route('Painel.Produto.destroy','teste')}}" method="POST" class="form-horizontal"> --}}
                            <form action="{{route('Painel.Produto.destroy','teste')}}" method="POST" class="form-horizontal">
                                {{method_field('delete')}}
                                {{ csrf_field()}}
                                <div class="modal-body">
                                    
                                    <p>
                                        Tem a certeza que pretende Apagar: 
                                    </p>
                                    <ul><li><span style="font-weight: bold " class="valueProduto"></span></li></ul>
                                    <p class="mt-2">
                                        Irá apagar todas a Etapa e Campo relacionado a este Produto
                                    </p>
                                    <input type="hidden" name="produto_id" id="id_delete" value="" >
                                    <input type="hidden" name="deletado" id="deletado" value="" >
                                    <input type="hidden" value="{{$userId}}" name="user" >

        
                                </div>
        
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Não</button>
                                    <button type="submit" class="btn btn-danger">Sim</button>
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
