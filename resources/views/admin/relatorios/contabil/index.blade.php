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
                    {!!Form::select('ano', $anos, old('ano'), ['class'=>'form-control', 'id'=>'ano_relatorio', 'required'=>'required'])!!}
                </div>
                <div class='col-md-3'>
                    {!!Form::label('mes', 'Mês', array('class'=>'control-label'))!!}
                    <div class="input-group">
                        {!!Form::select('mes', [''=>'Selecione o ano'], old('mes'), ['class'=>'form-control', 'id'=>'meses_relatorio', 'required'=>'required'])!!}
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
        <h3 class="text-right">Período: {{$periodo}} </h3>
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Descricao</th>
                    <th>Saldo Inicial</th>
                    <th>Enradas</th>
                    <th>Saídas</th>
                    <th>Devoluções</th>
                    <th>Saldo Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dados as $linha)
                @if($linha->id != null)
                <tr>
                    <td>{!! $linha->id !!}</td>
                    <td>{!! $linha->material_consumo !!}</td>
                    <td>{!! number_format($linha->vl_saldo_inicial, 2, ',', '.')!!}</td>
                    <td>{!! number_format($linha->vl_entrada, 2, ',', '.') !!}</td>
                    <td>{!! number_format($linha->vl_saida, 2, ',', '.') !!}</td>
                    <td>{!! number_format($linha->vl_devolucao, 2, ',', '.') !!}</td>
                    <td>{!! $saldo->present()->formatReal($saldo->present()->getValorSaldoFinal($linha))!!}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-right" colspan="2"><b>Totais</b></td>
                    <td><b>{{number_format($totais['saldo_inicial'], 2, ',', '.')}}</b></td>
                    <td><b>{{number_format($totais['entradas'], 2, ',', '.')}}</b></td>
                    <td><b>{{number_format($totais['saidas'], 2, ',', '.')}}</b></td>
                    <td><b>{{number_format($totais['devolucoes'], 2, ',', '.')}}</b></td>
                    <td><b>{{number_format($totais['saldo_final'], 2, ',', '.')}}</b></td>
                </tr>
            </tfoot>
        </table>
        @else
        <p>Selecione um período</p>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

