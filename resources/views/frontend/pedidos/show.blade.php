@extends('frontend.frontend_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or ("Pedido nº $pedido->id" ) !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
    </section>

    <!--Main content -->
    <section class = "content">
        <div class="container-fluid">
            <div class="box">
                <div class="box-body">
                    <div class="col-md-12">
                        <p><b>Status do pedido:</b> {{$pedido->status}}</p>
                        <p><b>Data do pedido:</b> {{date('d/m/Y',strtotime($pedido->created_at))}}</p>
                        <p><b>Justificativa:</b> {{$pedido->obs}}</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Qtd. solicitada</th>
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
