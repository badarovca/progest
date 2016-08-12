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
        <!-- Busca e filtros -->
        <br>
        <div class="row">
            <fieldset>
                <legend>Filtros</legend>
                {!! Form::open(array('route' => 'admin.materiais.index', 'method'=>'GET', 'class'=>'')) !!}
                <div class='col-md-10 '>
                    <div class="form-inline input-group ">

                        <div class='col-md-2'>
                            {!!Form::label('estq', 'Estoque', array('class'=>'control-label'))!!}
                            {!!Form::select('estq', $filter['estq'], old('em_estq'), ['class'=>'form-control', 'id'=>'estq'])!!}
                        </div>

                        <div class='col-md-2'>
                            {!!Form::label('disp', 'Disponibilidade', array('class'=>'control-label'))!!}
                            {!!Form::select('disp', $filter['disp'], old('disp'), ['class'=>'form-control', 'id'=>'disp'])!!}
                        </div>

                        <div class='col-md-3'>
                            {!!Form::label('qtd_min', 'Quantidade mínima', array('class'=>'control-label'))!!}
                            {!!Form::select('qtd_min', $filter['qtd_min'], old('qtd_min'), ['class'=>'form-control', 'id'=>'qtd_min'])!!}

                        </div>
                        <div class='col-md-4'>
                            {!!Form::label('busca', 'Busca', array('class'=>'control-label'))!!}
                            <!--<div class="input-group">-->
                                {!!Form::text('busca', old('busca'), array('class'=>'form-control', 'id' => 'busca', 'placeholder'=>'Código, descrição, marca...'))!!}
                                

                            <!--</div>-->
                        </div>
                        <div class='col-md-1'>
                            <label class="control-label"></label>
                            <span class="input-group">
                                    {!! Form::submit('Filtrar', ['class'=>'btn btn-default'])!!}
                                </span>
                        </div>
                    </div>
                </div>
                <div class='col-md-4'>

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

        <table id="listaMateriais" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Unidade</th>
                    <th>Quant.</th>
                    <th>subItem</th>
                    <th>Última alteração</th>
                    <th class='no-print'>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiais as $material)
                <tr>
                    <td>{!! $material->codigo !!}</td>
                    <td>{!! $material->descricao !!}</td>
                    <td>{!! $material->unidade->name !!}</td>
                    <td>{!! $material->present()->getQtdEstoque!!}</td>
                    <td>{!! $material->subItem->material_consumo !!}</td>
                    <td>{!! $material->present()->last_update !!}</td>
                    <td class='no-print' width="1%" nowrap>
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
                {!! str_replace('/?', '?', $materiais->appends($input)->render()) !!}
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

