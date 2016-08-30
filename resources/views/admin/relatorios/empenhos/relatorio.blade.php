
@extends('admin.relatorios.empenhos.index')
@section('relatorio')

@if(count($empenhos) > 0)

<h4 class="text-right">{!! $filtros['solicitante_id'] ? "Solicitante: ".$users[$filtros['solicitante_id']] : null !!}</h4>
<h4 class="text-right">{!! $filtros['setor_id'] ? "Setor: ".$setores[$filtros['setor_id']] : null !!}</h4>
<h4 class="text-right">{!! $filtros['coordenacao_id'] ? "Coordenação: ".$coordenacoes[$filtros['coordenacao_id']] : null !!}</h4>
<h4 class="text-right">{!! $filtros['fornecedor_id'] ? "Fornecedor: ".$fornecedores[$filtros['fornecedor_id']] : null !!}</h4>
<h4 class="text-right">{!! $filtros['status'] ? "Status: ".$status[$filtros['status']] : null !!}</h4>
<h4 class="text-right">{!! $filtros['periodo'] ? "Período: ".$filtros['periodo']['dt_inicial']." a ".$filtros['periodo']['dt_final'] : null !!}</h4>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Solicitante</th>
            <th>Nº do empenho</th>
            <th>Fornecedor</th>
            <th class="text-right">Vlr Total do empenho</th>
            <th class="text-right">Vlr  entregue</th>
            <th class="text-right">Vlr a receber</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empenhos as $empenho)
        <tr>
            <td>{!! $empenho->solicitante->name !!}</td>
            <td>{!! $empenho->numero !!}</td>
            <td>{!! $empenho->fornecedor->razao !!}</td>
            <td class="text-right">{!! $empenho->present()->getValorTotal() !!}</td>
            <td class="text-right">{!! $empenho->present()->getValorEntregue() !!}</td>
            <td class="text-right">{!! $empenho->present()->getValorRestante() !!}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="3"><b>Totais</b></td>
            <td class="text-right"><b>{!!$totais['total']!!}</b></td>
            <td class="text-right"><b>{!!$totais['totalEntregue']!!}</b></td>
            <td class="text-right"><b>{!!$totais['totalPendente']!!}</b></td>
        <tr>
    </tfoot>
</table>
@endif
@stop