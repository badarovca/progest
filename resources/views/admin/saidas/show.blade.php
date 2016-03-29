@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or ("Saída $saida->id" ) !!}
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
                    <h3 class="box-title">Saída de materiais</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Descricao</th>
                                <th>Vencimento</th>
                                <th>Qtd</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saida->subMateriais as $subMaterial)
                            <tr>
                                <td style="width: 10%">{{$subMaterial->material->codigo}}</td>
                                <td style="width: 58%">{{$subMaterial->material->descricao}}</td>
                                <td style="width: 58%">{{$subMaterial->present()->getVencimento()}}</td>
                                <td style="width: 5%">{{$subMaterial->pivot->quant}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Justificativa: </b>{{$saida->obs}}</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop
