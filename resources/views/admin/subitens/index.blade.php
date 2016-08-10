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
            {!! $page_title or "Subitens" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <small><a href="{!! route('admin.subitens.create') !!}">
                <i class="fa fa-plus"></i> Novo subitem
            </a></small>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($subitens) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Material de Consumo</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subitens as $subitem)
                <tr>
                    <td>{!! $subitem->id !!}</td>
                    <td>{!! $subitem->material_consumo !!}</td>
                    <td>{{$subitem->status == 1 ? 'Ativado' : 'Desativado' }}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.subitens.edit', $subitem->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
<!--                        <a href="{!! route('admin.subitens.destroy', $subitem->id) !!}" data-method="delete" data-confirm="Deseja remover o registro?" class="btn btn-danger btn-xs">
                            <i class="fa fa-fw fa-remove"></i> remover
                        </a>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="well">Nenhuma subitem ainda cadastrado.</h5>
        @endif
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $subitens->render()) !!}
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

