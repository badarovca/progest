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
        @include('template.alerts')
        <small><a href="{!! route('admin.usuarios.create') !!}">
                <i class="fa fa-plus"></i> Novo usuário
            </a></small>
        <!-- Busca e filtros -->

        <div class="row">
            <fieldset>
                <legend>Busca</legend>
                {!! Form::open(array('route' => 'admin.usuarios.index', 'method'=>'GET', 'class'=>'')) !!}
                <div class='col-md-2'>
                    {!!Form::label('habilitado', 'Habilitado', array('class'=>'control-label', 'title'=>'Itens com quantidade em estoque menor ou igual a quantidade mínima'))!!}
                    <div class="checkbox">
                        <label>
                            {!!Form::checkbox('habilitado', old('habilitado'), ['title'=>'Somente usuários habilitados'])!!} Usuários habilitados
                        </label>
                    </div>
                </div>
                <div class='col-md-8'>
                    {!!Form::label('sub_item_id', 'Busca', array('class'=>'control-label'))!!}
                    <div class="input-group">
                        {!!Form::text('busca', old('busca'), array('class'=>'form-control', 'id' => 'busca', 'placeholder'=>'Nome, email, SIAPE...'))!!}

                        <span class="input-group-btn">
                            {!! Form::submit('Ir', ['class'=>'btn btn-default'])!!}
                        </span>
                    </div>
                </div>
                <!--                <div class='col-md-2'><br>
                
                                </div>-->
                {!! Form::close() !!}
            </fieldset>
        </div>
        <br>
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        <div class="row">
            <div class="col-md-12">
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
                            <td>{{$usuario->habilitado == 1 ? 'Habilitado' : 'Desabilitado' }}</td>
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
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $usuarios->appends($input)->render()) !!}
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

