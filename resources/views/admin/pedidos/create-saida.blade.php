@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! "Pedido nº $pedido->id"  !!}
        </h1>
        <!--You can dynamically generate breadcrumbs here -->
        <ol class = "breadcrumb">
            <li><a href = "#"><i class = "fa fa-dashboard"></i> Level</a></li>
            <li class = "active">Here</li>
        </ol>
    </section>

    <!--Main content -->
    <section class = "content">
        <div id='response-msg'></div>
        {!! Form::open(['route' => ["admin.saidas.store"] ])!!}
        @include('admin.pedidos.form')
        <br>
        <div class="form-group">
            <div class='col-md-12'>
                {!!Form::submit('Salvar', ['class'=>'btn btn-primary pull-right'])!!}
            </div>
        </div>
        {!! Form::close()!!}

    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop

