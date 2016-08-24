
@extends('admin.relatorios.entradas.materiais.index')
@section('relatorio')

@if(count($entradas) > 0)

<h4 class="text-right">Período: {!!$periodo['dt_inicial']!!} a {!!$periodo['dt_final']!!}</h4>

@foreach($entradas as $entrada)
<h4 class="text-right">{!!$entrada["$criterioAtual"]!!}</h4>
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
        @foreach ($entrada['subMateriais'] as $subMaterial)
        <tr>
            <td>{!! $subMaterial->material->descricao !!}</td>
            <td>{!! $subMaterial->present()->getQtdEntregue() !!}</td>
            <td>{!! $subMaterial->present()->getValorUn() !!}</td>
            <td class="text-right">{!! $subMaterial->present()->getValorTotalEntregue() !!}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="3"><b>Sub Total</b></td>
            <td class="text-right" ><b>{!!$entrada['total']!!}</b></td>
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