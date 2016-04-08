@extends('admin.admin_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Relatório contábil" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <!-- Busca e filtros -->

        <div class="row">
            <fieldset>
                {!! Form::open(array('route' => 'admin.relatorios.contabil', 'method'=>'GET', 'class'=>'')) !!}
                <div class='col-md-2'>
                    {!!Form::label('ano', 'Ano', array('class'=>'control-label'))!!}
                    {!!Form::select('ano', $anos, old('ano'), ['class'=>'form-control', 'id'=>'ano', 'required'=>'required'])!!}
                </div>
                <div class='col-md-2'>
                    {!!Form::label('mes', 'Mês', array('class'=>'control-label'))!!}
                    <div class="input-group">
                        {!!Form::select('mes', $meses, old('mes'), ['class'=>'form-control', 'id'=>'mes', 'required'=>'required'])!!}
                        <span class="input-group-btn">
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
        @if(isset($dados))
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Descricao</th>
                    <th>Saldo Inicial</th>
                    <th>Enradas</th>
                    <th>Saídas</th>
                    <th>Saldo Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dados as $linha)
                <tr>
                    <td>{!! $linha->id !!}</td>
                    <td>{!! $linha->material_consumo !!}</td>
                    <td>{!! $linha->vl_saldo_inicial !!}</td>
                    <td>{!! $linha->vl_entrada + $linha->vl_devolucao !!}</td>
                    <td>{!! $linha->vl_saida -  $linha->vl_devolucao  !!}</td>
                    <td>{!! $linha->vl_saldo_final  !!}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Selecione um período</p>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

