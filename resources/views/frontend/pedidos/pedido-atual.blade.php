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
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Quant</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody id='lista-materiais'>
                                @foreach($itens as $item)
                                <tr>
                                    <td style="width: 75%">{{$item->name}}</td>
                                    <td style="width: 15%">{{$item->qty}}</td>
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop