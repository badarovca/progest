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
                    <h3 class="box-title"> Saída {{$saida->id}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <p><b>Solicitante: </b> {{$saida->solicitante->name}}</p>
                        <p><b>Data: </b> {{date('d/m/Y',strtotime($saida->created_at))}}</p>
                    </div>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Descricao</th>
                                <th>Qtd</th>
                                <th>Vl. unitário</th>
                                <th>Vl. total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saida->subMateriais as $subMaterial)
                            <tr>
                                <td style="width: 10%" class="text-center">{{$subMaterial->material->codigo}}</td>
                                <td style="width: 60%" class="text-center">{{$subMaterial->material->descricao}}</td>
                                <td style="width: 5%" class="text-center">{{$subMaterial->pivot->quant}}</td>
                                <td style="width: 10%" class="text-right">{{ $subMaterial->present()->getValorUn() }}</td>
                                <td style="width: 15%" class="text-right">{{ $subMaterial->present()->formatReal($subMaterial->pivot->quant * $subMaterial->present()->getValorUnBruto) }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-right" colspan="2"><b>Totais</b></td>
                                <td class="text-center">{{$saida->subMateriais()->count()}}</td>
                                <td></td>
                                <td class="text-right"><b>{{$saida->present()->getValorTotal()}}</b></td>
                            </tr>
                        </tfoot>
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
