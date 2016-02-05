@extends('admin.admin_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Usuários" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        <!--You can dynamically generate breadcrumbs here -->
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Level</a></li>
            <li class = "active">Here</li>
        </ol>
        @include('template.alerts')
        <small><a href="{!! route('admin.usuarios.create') !!}">
                <i class="fa fa-plus"></i> Novo usuário
            </a></small>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($usuarios) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Status</th>
                    <th>Email</th>
                    <th>Setor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                <tr>
                    <td>{!! $usuario->name !!}</td>
                    <td>{!! $usuario->status !!}</td>
                    <td>{!! $usuario->email !!}</td>
                    <td>{!! $usuario->setor->name !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.usuarios.edit', $usuario->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="well">Nenhum usuário ainda cadastrado.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

