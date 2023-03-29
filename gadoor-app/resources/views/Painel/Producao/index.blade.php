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
                        <h5 class=""> {{$urlAtual}} - Pagina teste</h5>
                        <a href="{{route('Painel.index')}}" 
                            class="btn btn-success btn-sm"
                            title="Retornar Painel" >
                            <i class="fas fa-home nav-icon"></i>
                            Voltar
                        </a>
                        
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Código</th>
                                        <th>Processo</th>
                                        <th>Responsavel</th>
                                        <th>Data Inicio</th>
                                        <th>Data Fim</th>
                                        <th>Duração</th>
                                        <th>Situação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr data-widget="expandable-table" aria-expanded="false" >
                                        <td><i class="fa-solid fa-eye"></i></td>
                                        <td>01</td>
                                        <td>Montagem</td>
                                        <td>Joelson Ramos</td>
                                        <td>10/01/2023</td>
                                        <td>20/01/2023</td>
                                        <td>10 dias</td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option></option>
                                                    <option>Em Produção</option>
                                                    <option>Em Aguardo</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="expandable-body">
                                        <td colspan="8" style="padding: 1% !important">

                                                <div class="row ">

                                                    <div class="col-4">
                                                        <div class=" mt-3 callout ">
                                                            <h5>Cotas</h5>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p>
                                                                        Altura Padieira
                                                                    </p>
                                                                </div>
                                                                
                                                                <div class="col-4">
                                                                    1500
                                                                </div>
                                                                <div class="col-2">
                                                                    <input type="checkbox">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p>
                                                                        Altura Padieira
                                                                    </p>
                                                                </div>
                                                                <div class="col-4">
                                                                    1900
                                                                </div>
                                                                <div class="col-2">
                                                                    <input type="checkbox">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class=" mt-2 callout ">
                                                            <h5>Bandeira</h5>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p>
                                                                        Largura
                                                                    </p>
                                                                </div>
                                                                <hr>
                                                                <div class="col-4">
                                                                    1900
                                                                </div>
                                                                <div class="col-2">
                                                                    <input type="checkbox">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p>
                                                                        Altura
                                                                    </p>
                                                                </div>
                                                                <div class="col-4">
                                                                    1900
                                                                </div>
                                                                <div class="col-2">
                                                                    <input type="checkbox">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <p>
                                                                        Desconta na Altura
                                                                    </p>
                                                                </div>
                                                                <div class="col-4">
                                                                    
                                                                </div>
                                                                <div class="col-2">
                                                                    <input type="checkbox">
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>

                                                </div>
                                        </td>
                                    </tr>
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td><i class="fa-solid fa-eye"></i></td>
                                        <td>02 </i></td>
                                        <td>Montagem</td>
                                        <td>Joelson Ferreira</td>
                                        <td>10/01/2023</td>
                                        <td>20/01/2023</td>
                                        <td>10 dias</td>
                                        <td>
                                            <div class="form-group">
                                                <select class="form-control">
                                                    <option>Concluido</option>
                                                    <option>Em Produção</option>
                                                    <option>Em Aguardo</option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="expandable-body">
                                        <td colspan="8" style="padding: 1% !important">
                                            <div class="row ">
                                                <div class="col-4">
                                                    <div class=" mt-3 callout ">
                                                        <h5>Cotas</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    Altura Padieira
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    1500
                                                                    
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    Altura Padieira
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    1500
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class=" mt-2 callout ">
                                                        <h5>Bandeira</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    Largura
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    1500
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    Altura
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    1500
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    Desconta na Altura
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    sim
                                                                </p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class=" mt-3 callout ">
                                                        <h5>Cotas</h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    Altura Padieira
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    1500
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <p>
                                                                    Altura Padieira
                                                                </p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p>
                                                                    1500
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection