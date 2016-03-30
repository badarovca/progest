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
            {!! $page_title or "Saídas" !!}
        </h1>
        <!--You can dynamically generate breadcrumbs here -->
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Level</a></li>
            <li class = "active">Here</li>
        </ol>
        @include('template.alerts')
        <small>
            <a href="{{ route('admin.saidas.create') }}">
                <i class="fa fa-plus"></i> Nova saída
            </a>
        </small>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($saidas) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Solicitante</th>
                    <th>Responsável</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($saidas as $saida)
                <tr>
                    <td>{!! $saida->id !!}</td>
                    <td>{!! $saida->solicitante->name !!}</td>
                    <td>{!! $saida->responsavel->name !!}</td>
                    <td>{!! date('d/m/Y',strtotime($saida->created_at)) !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.saidas.devolucoes.index', $saida->id) !!}" class="btn btn-warning btn-xs">
                            <i class="fa fa-fw fa-arrow-down"></i> devoluções
                        </a>
                        @if($saida->devolucoes->count() == 0)
                        <a href="{!! route('admin.saidas.destroy', $saida->id) !!}" data-method="delete" data-confirm="Deseja cancelar a saída?" class="btn btn-danger btn-xs">
                            <i class="fa fa-fw fa-remove"></i> cancelar
                        </a>
                        @endif
                        <a href="{!! route('admin.saidas.show', $saida->id) !!}" class="btn btn-info btn-xs">
                            <i class="fa fa-fw fa-eye"></i> visualizar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $saidas->render()) !!}
            </div>
        </div>
        @else
        <h5 class="well">Nenhuma saida ainda cadastrado.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

