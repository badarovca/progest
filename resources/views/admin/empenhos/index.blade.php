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
            {!! $page_title or "Empenhos" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <small><a href="{!! route('admin.empenhos.create') !!}">
                <i class="fa fa-plus"></i> Novo empenho
            </a></small>
        <br>

        <!-- Busca e filtros -->
        <fieldset>

                <legend>Busca</legend>
                {!! Form::open(array('route' => 'admin.empenhos.index', 'method'=>'GET', 'class'=>'')) !!}
                <div class="row">
                    <div class='col-md-4'>
                        {!!Form::label('busca', 'Empenho', array('class'=>'control-label'))!!}
                        {!!Form::text('busca', old('busca'), array('class'=>'form-control', 'id' => 'busca', 'placeholder'=>'Número do empenho ou modalidade da licitação'))!!}
                    </div>
                    <div class='col-md-4'>
                        {!!Form::label('fornecedor_id', 'Fornecedor', array('class'=>'control-label'))!!}
                        {!!Form::select('fornecedor_id', $fornecedores, null, ['class'=>'form-control select-filtro', 'id'=>'fornecedor_id'])!!}
                    </div>
                    <div class='col-md-3'>
                        {!!Form::label('status', 'Status', array('class'=>'control-label'))!!}
                        {!!Form::select('status', $status, null, ['class'=>'form-control select-filtro', 'id'=>'status'])!!}
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class='col-md-4'>
                        {!!Form::label('solicitante_id', 'Solicitante', array('class'=>'control-label'))!!}
                        {!!Form::select('solicitante_id', $users, null, ['class'=>'form-control select-filtro', 'id'=>'solicitante_id'])!!}
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
                <!--                <div class='col-md-2'><br>
                
                                </div>-->
                {!! Form::close() !!}
        </fieldset>

<br>
</section>

<!--Main content -->
<section class = "content">
    <!--Your Page Content Here -->
    @if(count($empenhos) > 0)
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Número</th>
                <th>Fornecedor</th>
                <th>Tipo</th>
                <th>Modalidade</th>
                <th>Nº processo.</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($empenhos as $empenho)
            <tr>
                <td>{!! $empenho->numero !!}</td>
                <td>{!! $empenho->fornecedor->razao !!}</td>
                <td>{!! $empenho->tipo !!}</td>
                <td>{!! $empenho->mod_licitacao !!}</td>
                <td>{!! $empenho->num_processo !!}</td>
                <td width="1%" nowrap>
                    <a href="{!! route('admin.empenhos.entradas.index', $empenho->id) !!}" class="btn btn-warning btn-xs">
                        <i class="fa fa-fw fa-archive"></i> entradas
                    </a>
                    @if($empenho->entradas()->count() == 0)
                    <a href="{!! route('admin.empenhos.edit', $empenho->id) !!}" class="btn btn-primary btn-xs">
                        <i class="fa fa-fw fa-pencil"></i> editar
                    </a>
                    <a href="{!! route('admin.empenhos.destroy', $empenho->id) !!}" data-method="delete" data-confirm="Deseja remover o registro?" class="btn btn-danger btn-xs">
                        <i class="fa fa-fw fa-remove"></i> remover
                    </a>
                    @else
                    <a href="{!! route('admin.empenhos.show', $empenho->id) !!}" class="btn btn-primary btn-xs">
                        <i class="fa fa-fw fa-eye"></i> visualizar
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h5 class="well">Nenhum empenho ainda cadastrado.</h5>
    @endif
</section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

