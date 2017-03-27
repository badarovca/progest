
@extends('admin.relatorios.saidas.materiais.index')
@section('relatorio')

@if(count($saidas) > 0)

<h4 class="text-right">Consumo por {!! $criterios[$criterioAtual] or null!!} - Período: {!!$periodo['dt_inicial']!!} a {!!$periodo['dt_final']!!}</h4>

@foreach($saidas as $key=>$saida)
<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">
            <button type="button" class="btn-link pull-right link-black">
                <h4 class="text-right clickable" data-toggle="collapse" data-target=".saida-{{$key}}">{!!$saida["$criterioAtual"]!!}</h4>
            </button>
        </div>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="collapse out saida-{{$key}}">
                <th>Descrição do item</th>
                <th>Quantidade</th>
                <th>Vl. unitário</th>
                <th>Vl. total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($saida['subMateriais'] as $subMateriais)
            @foreach ($subMateriais as $subMaterial)
            <tr class="collapse out saida-{{$key}}">
                <td>{!! $subMaterial->material->descricao !!}</td>
                <td>{!! $subMaterial->pivot->quant !!}</td>
                <td>{!! $subMaterial->present()->getValorUn() !!}</td>
                <td class="text-right">{!! $subMaterial->present()->formatReal($subMaterial->pivot->quant * $subMaterial->present()->getValorUnBruto) !!}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
    <div class="panel-footer">
        <div class='row'>
            <div class='col-md-4 col-lg-offset-8 text-right'>
                <span>SubTotal: </span> <b>{!!$saida['total']!!}</b>
            </div>
        </div>
    </div>
</div>


@endforeach
<br>
<div class="row">
    <div class="col-md-6 pull-right">
        <p class="text-right">Total no período: <b>{!!$total!!}</b></p>
    </div>
</div>
@endif
@stop