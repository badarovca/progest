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
        <!--You can dynamically generate breadcrumbs here -->
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Level</a></li>
            <li class = "active">Here</li>
        </ol>
        @include('template.alerts')
        <small><a href="{!! route('admin.materiais.create') !!}">
                <i class="fa fa-plus"></i> Novo material
            </a></small>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($materiais) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Unidade</th>
                    <th>Quant.</th>
                    <th>subItem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materiais as $material)
                <tr>
                    <td>{!! $material->codigo !!}</td>
                    <td>{!! $material->descricao !!}</td>
                    <td>{!! $material->unidade !!}</td>
                    <td>{!! $material->qtd_1 + $material->qtd_2 + $material->qtd_3 + $material->qtd_4!!}</td>
                    <td>{!! $material->subItem->material_consumo !!}</td>
                    <td width="1%" nowrap>
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
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

