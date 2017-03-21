@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or ("Pedido $pedido->id - " ) !!}
            <small>
                <a href="{!! route('admin.saidas.show', $pedido->saida->id) !!}">
                    Visualizar saída
                </a>
            </small>
        </h1>
    </section>

    <!--Main content -->
    <section class = "content">
        <div class="container-fluid">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title">Solicitante: {{$pedido->solicitante->name}} - Pedido {{$pedido->id}}</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-md-12">
                        <p><b>Status do pedido:</b> {{$pedido->status}}</p>
                        <p><b>Data do pedido:</b> {{date('d/m/Y',strtotime($pedido->created_at))}}</p>
                        <p><b>Justificativa:</b> {{$pedido->obs}}</p>
                    </div>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
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
                    <br><br>
                    @if($pedido->saida != null)
                    <h3 class="text-center">Itens entregues</h3>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Qtd</th>
                                <th>Vl. unitário</th>
                                <th>Vl. total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->saida->subMateriais as $subMaterial)
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
                                <td class="text-center">{{$pedido->saida->subMateriais()->count()}}</td>
                                <td></td>
                                <td class="text-right"><b>{{$pedido->saida->present()->getValorTotal()}}</b></td>
                            </tr>
                        </tfoot>
                    </table>
                    <h3 class="text-center">Observações</h3>
                    <p>{{$pedido->saida->obs}}</p>
                    @endif
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop
