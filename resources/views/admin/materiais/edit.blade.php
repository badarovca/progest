@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Editar material" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
    </section>

    <!--Main content -->
    <section class = "content">
        {!! Form::model($material, ['route' => ['admin.materiais.update', $material->id], 'method'=>'PUT', 'files'=>true])!!}
        @include('admin.materiais.form')
        <div class="form-group">
            <div class='col-md-12'>
                {!!Form::submit('Salvar', ['class'=>'btn btn-primary pull-right'])!!}
            </div>
        </div>
        {!! Form::close()!!}
        <br>
        <br>
        @if(count($submaterial) > 0)
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Submaterial</th>
                    <th>Vencimento</th>
                    <th>Solicitado</th>
                    <th>Em estoque</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submaterial as $submaterial)
                <tr>
                    <td>{!! $submaterial->id !!}</td>
                    <td>{!! $submaterial->present()->getVencimento() !!}</td>
                    <td>{!! $submaterial->qtd_solicitada !!}</td>
                    <td>{!! $submaterial->qtd_estoque !!}</td>
                    <td>{!! $submaterial->present()->getValorUn() !!}</td>
                    <td width="1%" nowrap>
                        <a href="{!! route('admin.submateriais.edit', $submaterial->id) !!}" class="btn btn-primary btn-xs">
                            <i class="fa fa-fw fa-pencil"></i> editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h5 class="well">Nenhum submaterial ainda cadastrado.</h5>
        @endif

    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

