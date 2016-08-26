
@extends('admin.relatorios.saidas.materiais.index')
@section('relatorio')

@if(count($saidas) > 0)

<h4 class="text-right">Consumo por {!! $criterios[$criterioAtual] or null!!} - Período: {!!$periodo['dt_inicial']!!} a {!!$periodo['dt_final']!!}</h4>

@foreach($saidas as $saida)
<h4 class="text-right">{!!$saida["$criterioAtual"]!!}</h4>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Descrição do item</th>
            <th>Quantidade</th>
            <th>Vl. unitário</th>
            <th>Vl. total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($saida['subMateriais'] as $subMateriais)
        @foreach ($subMateriais as $subMaterial)
        <tr>
            <td>{!! $subMaterial->material->descricao !!}</td>
            <td>{!! $subMaterial->pivot->quant !!}</td>
            <td>{!! $subMaterial->present()->getValorUn() !!}</td>
            <td class="text-right">{!! $subMaterial->present()->formatReal($subMaterial->pivot->quant * $subMaterial->present()->getValorUnBruto) !!}</td>
        </tr>
        @endforeach
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="3"><b>Sub Total</b></td>
            <td class="text-right" ><b>{!!$saida['total']!!}</b></td>
        <tr>
    </tfoot>
</table>
@endforeach
<div class="row">
    <div class="col-md-6 pull-right">
        <p class="text-right">Total no período: <b>{!!$total!!}</b></p>
    </div>
</div>
@endif
@stop