@extends('admin.admin_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Relatório - Entradas de NF's por período" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <!-- Busca e filtros -->
        <br>
        <div class="row">
            <fieldset>
                {!! Form::open(array('route' => 'admin.relatorios.entradas-nf', 'method'=>'GET', 'class'=>'')) !!}
                <div class='col-md-3'>
                    {!!Form::label('numero', 'Número empenho', array('class'=>'control-label'))!!}
                    {!!Form::text('numero', null, array('class'=>'form-control', 'id' => 'numero'))!!}
                </div>
                <div class='col-md-4'>
                    {!!Form::label('fornecedor_id', 'Fornecedor', array('class'=>'control-label'))!!}
                    {!!Form::select('fornecedor_id', $fornecedores, null, ['class'=>'form-control', 'id'=>'fornecedor_id'])!!}
                </div>
                <div class='col-md-2'>
                    {!!Form::label('dt_inicial', 'Data Inicial', array('class'=>'control-label'))!!}
                    {!!Form::date('dt_inicial', old('dt_inicial'), ['class'=>'form-control', 'id'=>'dt_inicial'])!!}
                </div>
                <div class='col-md-2'>
                    {!!Form::label('dt_final', 'Data Final', array('class'=>'control-label'))!!}
                    {!!Form::date('dt_final', old('dt_final'), ['class'=>'form-control', 'id'=>'dt_final'])!!}
                </div>
                <div class='col-md-1'>
                    <div class="input-group">
                        {!!Form::label('', '', array('class'=>'control-label'))!!}
                        <span class="input-group">
                            {!! Form::submit('Ir', ['class'=>'btn btn-default'])!!}
                        </span>
                    </div>
                </div>
                {!! Form::close() !!}
            </fieldset>
        </div>
        <br>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($entradas) > 0)
        <h3 class="text-center">Entradas de Notas Fiscais - {!! $fornecedor or null !!}</h3>
        <h3 class="text-right">Período: {!! $periodo or null !!}</h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Nota Fiscal</th>
                    <th>Fornecedor</th>
                    <th>Empenho</th>
                    <th>Data de recebimento</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entradas as $entrada)
                <tr>
                    <td>{!! $entrada->num_nf !!}</td>
                    <td>{!! $entrada->empenho->fornecedor->razao !!}</td>
                    <td>{!! $entrada->empenho->numero !!}</td>
                    <td>{!! $entrada->present()->formatDate($entrada->dt_recebimento) !!}</td>
                    <td>{!! $entrada->present()->getValorTotal() !!}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="4"><b>Total</b></td>
                    <td class="text-left" ><b>{!!$total!!}</b></td>
                <tr>
            </tfoot>
        </table>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

