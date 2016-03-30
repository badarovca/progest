@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or ("Devolução $devolucao->id" ) !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
    </section>

    <!--Main content -->
    <section class = "content">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><a href="{!! route('admin.saidas.devolucoes.index', $devolucao->saida->id) !!}">Saída {{$devolucao->saida->id}}</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Descricao</th>
                                <th>Qtd</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devolucao->subMateriais as $subMaterial)
                            <tr>
                                <td style="width: 10%">{{$subMaterial->material->codigo}}</td>
                                <td style="width: 58%">{{$subMaterial->material->descricao}}</td>
                                <td style="width: 5%">{{$subMaterial->pivot->quant}}</td>
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
