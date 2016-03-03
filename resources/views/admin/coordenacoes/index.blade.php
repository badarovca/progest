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
            {!! $page_title or "Coordenações" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <small><a href="{!! route('admin.coordenacoes.create') !!}">
                <i class="fa fa-plus"></i> Nova coordenação
            </a></small>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($coordenacoes) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Coordenador</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coordenacoes as $coordenacao)
                <tr>
                    <td>{!! $coordenacao->name !!}</td>
                    <td>{!! $coordenacao->coordenador !!}</td>
                    <td>{!! $coordenacao->telefone !!}</td>
                    <td>{!! $coordenacao->email !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.coordenacoes.edit', $coordenacao->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                        <a href="{!! route('admin.coordenacoes.destroy', $coordenacao->id) !!}" data-method="delete" data-confirm="Deseja remover o registro?" class="btn btn-danger btn-xs">
                            <i class="fa fa-fw fa-remove"></i> remover
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="well">Nenhuma coordenação ainda cadastrada.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

