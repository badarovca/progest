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
            {!! $page_title or "Fornecedores" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <small><a href="{!! route('admin.fornecedores.create') !!}">
                <i class="fa fa-plus"></i> Novo fornecedor
            </a></small>

        <div class="row">
            <fieldset>
                <legend>Busca</legend>
                {!! Form::open(array('route' => 'admin.fornecedores.index', 'method'=>'GET', 'class'=>'')) !!}
                <div class='col-md-2'>
                    {!!Form::label('habilitado', 'Habilitado', array('class'=>'control-label', 'title'=>'Itens com quantidade em estoque menor ou igual a quantidade mínima'))!!}
                    {!!Form::select('habilitado', ['1'=>'Habilitado', '0'=>'Desabilitado' ], old('habilitado'), ['class'=>'form-control'])!!}
                </div>
                <div class='col-md-8'>
                    {!!Form::label('sub_item_id', 'Busca', array('class'=>'control-label'))!!}
                    <div class="input-group">
                        {!!Form::text('busca', old('busca'), array('class'=>'form-control', 'id' => 'busca', 'placeholder'=>'Razão social, fantasia, ou CNPJ da empresa'))!!}

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
    </section>

    <!--Main content -->
    <section class = "content">
        <!--Your Page Content Here -->
        @if(count($fornecedores) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Nome Fantasia</th>
                    <th>CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fornecedores as $fornecedor)
                <tr>
                    <td>{!! $fornecedor->fantasia !!}</td>
                    <td>{!! $fornecedor->cnpj !!}</td>
                    <td>{!! $fornecedor->email !!}</td>
                    <td>{!! $fornecedor->telefone1 !!}</td>
                    <td>{{$fornecedor->status == 1 ? 'Ativado' : 'Desativado' }}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.fornecedores.edit', $fornecedor->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                        <!--                        <a href="{!! route('admin.fornecedores.destroy', $fornecedor->id) !!}" data-method="delete" data-confirm="Deseja remover o registro?" class="btn btn-danger btn-xs">
                                                    <i class="fa fa-fw fa-remove"></i> remover
                                                </a>-->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12 text-center">
                {!! str_replace('/?', '?', $fornecedores->render()) !!}
            </div>
        </div>
        @else
        <h5 class="well">Nenhum fornecedor ainda cadastrado.</h5>
        @endif
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

