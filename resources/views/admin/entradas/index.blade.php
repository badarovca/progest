@extends('admin.admin_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Entradas - " !!}
            <small>Empenho: <b>{!! $empenho->numero or "todos"!!}</b></small>
        </h1>
        <!--You can dynamically generate breadcrumbs here -->
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Level</a></li>
            <li class = "active">Here</li>
        </ol>
        @include('template.alerts')
        @if(isset($empenho))
            <small><a href="{{ route('admin.empenhos.entradas.create', [$empenho->id]) }}">
                <i class="fa fa-plus"></i> Nova entrada
            </a></small>
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
                    <td>{!! $entrada->vl_total !!}</td>
                    <td>{!! $entrada->dt_recebimento !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.empenhos.entradas.edit', [$entrada->empenho->id, $entrada->id]) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="well">Nenhuma entrada ainda cadastrado.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

