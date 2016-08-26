@extends('admin.admin_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Relatório - Saídas de materiais por período" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <!-- Busca e filtros -->
        <br>
        <fieldset>
            <div class="row">

                {!! Form::open(array('route' => 'admin.relatorios.saidas-materiais', 'method'=>'GET', 'class'=>'')) !!}
                <div class='col-md-12'>
                    {!!Form::label('', 'Agrupar por:', array('class'=>'control-label'))!!}
                </div>
                <div class="col-md-4">
                    {!!Form::radio('criterio', 'solicitante', false ,array('class'=>'criterio-filtro', 'id'=>'criterio1'))!!}
                    {!!Form::label('criterio1', 'Solicitante')!!}
                </div>
                <div class="col-md-4">
                    {!!Form::radio('criterio', 'setor', false ,array('class'=>'criterio-filtro', 'id'=>'criterio2'))!!}
                    {!!Form::label('criterio2', 'Setor')!!}
                </div>
                <div class="col-md-4">
                    {!!Form::radio('criterio', 'coordenacao', false ,array('class'=>'criterio-filtro', 'id'=>'criterio3'))!!} 
                    {!!Form::label('criterio3', 'Coordenação')!!}
                </div>
                <div class='col-md-4'>
                    {!!Form::label('solicitante_id', 'Solicitante', array('class'=>'control-label'))!!}
                    {!!Form::select('solicitante_id', $users, null, ['class'=>'form-control select-filtro', 'id'=>'solicitante_id', 'disabled'=>'disabled'])!!}
                </div>
                <div class='col-md-4'>
                    {!!Form::label('setor_id', 'Setor', array('class'=>'control-label'))!!}
                    {!!Form::select('setor_id', $setores, null, ['class'=>'form-control select-filtro', 'id'=>'setor_id', 'disabled'=>'disabled'])!!}
                </div>
                <div class='col-md-4'>
                    {!!Form::label('coordenacao_id', 'Coordenação', array('class'=>'control-label'))!!}
                    {!!Form::select('coordenacao_id', $coordenacoes, null, ['class'=>'form-control select-filtro', 'id'=>'coordenacao_id', 'disabled'=>'disabled'])!!}
                </div>
            </div>
            <br>
            <div class="row">
                <div class='col-md-2'>
                    {!!Form::label('dt_inicial', 'Data Inicial', array('class'=>'control-label'))!!}
                    {!!Form::date('dt_inicial', old('dt_inicial'), ['class'=>'form-control', 'id'=>'dt_inicial', 'required'=>'required'])!!}
                </div>
                <div class='col-md-2'>
                    {!!Form::label('dt_final', 'Data Final', array('class'=>'control-label'))!!}
                    {!!Form::date('dt_final', old('dt_final'), ['class'=>'form-control', 'id'=>'dt_final', 'required'=>'required'])!!}
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
            </div>
        </fieldset>
        <br>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @yield('relatorio')
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

