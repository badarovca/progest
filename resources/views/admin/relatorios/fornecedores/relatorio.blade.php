
@extends('admin.relatorios.fornecedores.index')
@section('relatorio')

@if(count($fornecedores) > 0)
@foreach($fornecedores as $fornecedor)
<div class="row">
    <div class="col-md-8"><h4>Fornecedor: {!! $fornecedor->razao !!}</h4></div>
    <div class="col-md-4"><h4>Contato: {!! $fornecedor->telefone1 !!} | {!! $fornecedor->telefone2 !!}</h4></div>
</div>

<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Empenho</th>
            <th>Vlr total</th>
            <th>Vlr pendente</th>
        </tr>
    </thead>
    <tbody>
        @foreach($fornecedor->empenhos as $empenho)
        @if (!$empenho->present()->isFechado())
        <tr>
            <td>{!! $empenho->numero !!}</td>
            <td>{!! $empenho->present()->getValorEntregue() !!}</td>
            <td>{!! $empenho->present()->getValorRestante() !!}</td>
        </tr>
        @endif

        @endforeach
    </tbody>
</table>
<br>
@endforeach
@endif
@stop