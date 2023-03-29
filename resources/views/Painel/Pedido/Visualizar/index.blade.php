@extends('Painel.layout.index')
@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-12">
                {{-- <h5>{{$produto->name}}</h5> --}}
                @foreach ($visualizar as $item)
                <h2>{{$item->name}}</h2>
                <h2>{{$item->nome_etapa}}</h2>
                <h2>{{$item->name_campo}}</h2>
                <h2>{{$item->name_item}}</h2>
                <h2>{{$item->item}}</h2>
                @endforeach
                
            </div>
        </div>

    </div>

</section>
<!-- /.content -->

@endsection
