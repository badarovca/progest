@extends('frontend.frontend_template')

@section('content')

<!-- Laravel DELETE plugin -->
<script>
    window.csrfToken = '<?php echo csrf_token(); ?>';
</script>
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->

    <section class = "content-header container">
        <h1>
            {{ "Pedido atual" }}
        </h1>
    </section>

    <!--Main content -->
    <section class = "content container">
        <!--Your Page Content Here -->
        @include('template.alerts')
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Materiais</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Quant</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody id='lista-materiais'>
                                        {!! Form::open(array('route' => 'pedidos.store')) !!}
                                        @foreach($itens as $item)
                                        <tr>
                                            <td style="width: 80%">{{$item->name}}</td>
                                            <td style="width: 10%">{!!Form::text("qtds[$item->id]", $item->qty, array('class'=>'form-control', 'id' => "qtds[$item->id]", 'required' => 'required', 'readonly' => 'true'))!!}</td>
                                            <td style="width: 10%">
                                                <a href="{!! route('pedidos.remover-material', $item->rowid) !!}" data-method="delete" data-confirm="Deseja remover estes itens do pedido?" class="btn btn-danger btn-xs">
                                                    <i class="fa fa-fw fa-remove"></i> remover
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <p>Materiais: {{Cart::count(false)}} - Total: {{Cart::count()}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class='form-group'>
                                <div class='col-md-12'>
                                    {!!Form::label('obs', 'Justificativa', array('class'=>'control-label'))!!}
                                    {!!Form::textarea('obs', null, array('class'=>'form-control', 'id' => 'obs', 'required' => 'required', 'rows'=>'3'))!!}
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-md-offset-9">
                                <a class="link-black" href="{{route('pedidos')}}">Adicionar itens</a>
                                {!! Form::submit('Finalizar pedido', ['class'=>'btn btn-success pull-right'])!!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <!--/.box-body--> 
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop