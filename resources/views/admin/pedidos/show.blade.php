@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or ("Pedido nº $pedido->id" ) !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        <!--You can dynamically generate breadcrumbs here -->
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Level</a></li>
            <li class = "active">Here</li>
        </ol>
    </section>

    <!--Main content -->
    <section class = "content">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Solicitante: {{$pedido->solicitante->name}} (id: {{$pedido->solicitante->id}})</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Descricao</th>
                                <th>Qtd solicitada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->materiais as $material)
                            <tr>
                                <td style="width: 10%">{{$material->codigo}}</td>
                                <td style="width: 75%">{{$material->descricao}}</td>
                                <td style="width: 15%">{{$material->pivot->quant}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop
