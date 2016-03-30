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
            {!! $page_title or "Devoluções - " !!}
            <small>Saída: <b>{!! $saída->id or "todas"!!}</b></small>
        </h1>
        @include('template.alerts')
        @if(isset($saida))
        <small><a href="{{ route('admin.saidas.devolucoes.create', [$saida->id]) }}">
                <i class="fa fa-plus"></i> Nova devolução
            </a></small>
        @endif
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($devolucoes) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Saída</th>
                    <th>Solicitante</th>
                    <th>Responsável</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devolucoes as $devolucao)
                <tr>
                    <td>{!! $devolucao->id !!}</td>
                    <td>{!! $devolucao->saida->id !!}</td>
                    <td>{!! $devolucao->saida->solicitante->name !!}</td>
                    <td>{!! $devolucao->saida->responsavel->name !!}</td>
                    <td>{!! $devolucao->present()->formatDate($devolucao->created_at) !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.saidas.devolucoes.destroy', [$devolucao->saida->id, $devolucao->id]) !!}"  data-method="delete" data-confirm="Deseja cancelar a devolução?" class="btn btn-danger btn-xs">
                            <i class="fa fa-fw fa-remove"></i> cancelar
                        </a>
                        <a href="{!! route('admin.saidas.devolucoes.show', [$devolucao->saida->id, $devolucao->id]) !!}" class="btn btn-info btn-xs">
                            <i class="fa fa-fw fa-eye"></i> visualizar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $devolucoes->render()) !!}
            </div>
        </div>
        @else
        <h5 class="well">Nenhuma devolução ainda cadastrada.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

