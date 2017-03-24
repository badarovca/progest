@extends('admin.admin_template')

@section('content')
<!-- Laravel DELETE plugin -->
<script>
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Entradas - " !!}
            <small>Empenho: <b>{!! $empenho->numero or ""!!}</b></small>
        </h1>
        @include('template.alerts')
        @if(isset($empenho))
        <small><a href="{{ route('admin.empenhos.entradas.create', [$empenho->id]) }}">
                <i class="fa fa-plus"></i> Nova entrada
            </a></small>
        @endif
        <!-- Busca e filtros -->
        @if (!isset($empenho))
        <fieldset>

            <legend>Busca</legend>
            {!! Form::open(array('route' => 'admin.entradas', 'method'=>'GET', 'class'=>'')) !!}
            <div class="row">
                <div class='col-md-3'>
                    {!!Form::label('empenho', 'Número empenho', array('class'=>'control-label'))!!}
                    {!!Form::text('empenho', old('busca'), array('class'=>'form-control', 'id' => 'busca', 'placeholder'=>'Número do empenho'))!!}
                </div>
                <div class='col-md-4'>
                    {!!Form::label('fornecedor_id', 'Fornecedor', array('class'=>'control-label'))!!}
                    {!!Form::select('fornecedor_id', $fornecedores, null, ['class'=>'form-control select-filtro', 'id'=>'fornecedor_id'])!!}
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
            </div>
            {!! Form::close() !!}
        </fieldset>
        @endif
    </section>



    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($entradas) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Número NF</th>
                    <th>Fornecedor</th>
                    <th>Natureza da operação</th>
                    <th>Valor</th>
                    <th>Data do recebimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entradas as $entrada)
                <tr>
                    <td>{!! $entrada->num_nf !!}</td>
                    <td>{!! $entrada->empenho->fornecedor->razao !!}</td>
                    <td>{!! $entrada->natureza_op !!}</td>
                    <td>{!! $entrada->present()->getValorTotal() !!}</td>
                    <td>{!! $entrada->present()->formatDate($entrada->dt_recebimento) !!}</td>
                    <td width="1%" nowrap>
                        @if(!$entrada->present()->verificaSaidas())
                        <a href="{!! route('admin.empenhos.entradas.destroy', [$entrada->empenho->id, $entrada->id]) !!}"  data-method="delete" data-confirm="Deseja cancelar a entrada?" class="btn btn-danger btn-xs">
                            <i class="fa fa-fw fa-remove"></i> cancelar
                        </a>
                        @endif
                        <a href="{!! route('admin.empenhos.entradas.show', [$entrada->empenho->id, $entrada->id]) !!}" class="btn btn-info btn-xs">
                            <i class="fa fa-fw fa-eye"></i> visualizar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $entradas->render()) !!}
            </div>
        </div>
        @else
        <h5 class="well">Nenhuma entrada ainda cadastrado.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

