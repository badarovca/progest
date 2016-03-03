@extends('admin.admin_template')

@section('content')
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
                    <td>{!! $empenho->mod_aplicacao !!}</td>
                    <td>{!! $empenho->num_processo !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.empenhos.entradas.index', $empenho->id) !!}" class="btn btn-warning btn-xs">
                            <i class="fa fa-fw fa-archive"></i> entradas
                        </a>
                        <a href="{!! route('admin.empenhos.edit', $empenho->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
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

