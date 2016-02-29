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
            {!! $page_title or "Setores" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        <!--You can dynamically generate breadcrumbs here -->
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Level</a></li>
            <li class = "active">Here</li>
        </ol>
        @include('template.alerts')
        <small><a href="{!! route('admin.setores.create') !!}">
                <i class="fa fa-plus"></i> Novo setor
            </a></small>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($setores) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Coordenação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($setores as $setor)
                <tr>
                    <td>{!! $setor->name !!}</td>
                    <td>{!! $setor->coordenacao->name !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.setores.edit', $setor->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                        <a href="{!! route('admin.setores.destroy', $setor->id) !!}" data-method="delete" data-confirm="Deseja remover o registro?" class="btn btn-danger btn-xs">
                            <i class="fa fa-fw fa-remove"></i> remover
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="well">Nenhum setor ainda cadastrado.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

