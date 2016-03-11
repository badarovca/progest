@extends('admin.admin_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Materiais" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <small><a href="{!! route('admin.materiais.create') !!}">
                <i class="fa fa-plus"></i> Novo material
            </a></small>
        <!-- Busca e filtros -->

        <div class="row">
            <fieldset>
                <legend>Busca</legend>
                {!! Form::open(array('route' => 'admin.materiais.index', 'method'=>'GET', 'class'=>'')) !!}
                <!--<div class="input-group">-->
                <div class='col-md-2'>
                    {!!Form::label('sub_item_id', 'Quantidade mínima', array('class'=>'control-label'))!!}
                    <div class="checkbox">
                        <label>
                            {!!Form::checkbox('qtd_min', old('qtd_min'))!!} Quantidade mínima
                        </label>
                    </div>
                </div>
                <div class='col-md-2'>
                    {!!Form::label('sub_item_id', 'Unidade', array('class'=>'control-label'))!!}
                    {!!Form::select('unidade', $unidades, old('unidade'), ['class'=>'form-control', 'id'=>'unidade'])!!}
                </div>
                <div class='col-md-2'>
                    {!!Form::label('sub_item_id', 'Subitem', array('class'=>'control-label'))!!}
                    {!!Form::select('subitem', $subitens, old('subitem'), ['class'=>'form-control', 'id'=>'subitem'])!!}
                </div>
                <div class='col-md-4'>
                    {!!Form::label('sub_item_id', 'Busca', array('class'=>'control-label'))!!}
                    <div class="input-group">
                    {!!Form::text('busca', old('busca'), array('class'=>'form-control', 'id' => 'busca', 'placeholder'=>'Código, descrição, marca...'))!!}
                    
                        <span class="input-group-btn">
                            {!! Form::submit('Ir', ['class'=>'btn btn-default'])!!}
                        </span>
                    </div>
                </div>
<!--                <div class='col-md-2'><br>

                </div>-->
                {!! Form::close() !!}
            </fieldset>
        </div>
        <br>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($materiais) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Unidade</th>
                    <th>Quant.</th>
                    <th>subItem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiais as $material)
                <tr>
                    <td>{!! $material->codigo !!}</td>
                    <td>{!! $material->descricao !!}</td>
                    <td>{!! $material->unidade->name !!}</td>
                    <td>{!! $material->qtd_1 + $material->qtd_2 + $material->qtd_3 + $material->qtd_4!!}</td>
                    <td>{!! $material->subItem->material_consumo !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.materiais.edit', $material->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="well">Nenhum material ainda cadastrado.</h5>
        @endif
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $materiais->render()) !!}
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

