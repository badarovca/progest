@extends('frontend.frontend_template')

@section('content')
<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header container">
        <h1>
            {!! $page_title or "Meus pedidos" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
        @include('template.alerts')
        <small><a href="{!! route('pedidos') !!}">
                <i class="fa fa-plus"></i> Novo pedido
            </a></small>
    </section>

    <!--Main content -->
    <section class = "content container">
        <div class="row">
            <div class="col-md-12">
                <!--Your Page Content Here -->
                <div class="box">
                    <div class="box-dody">
                        @if(count($pedidos) > 0)
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedidos as $pedido)
                                <tr>
                                    <td>{!! $pedido->id !!}</td>
                                    <td>{!! date('d/m/Y',strtotime($pedido->created_at)) !!}</td>
                                    <td>{!! $pedido->status !!}</td>
                                    <td width="1%" nowrap>
                                        <a href="{!! route('pedidos.show', $pedido->id) !!}" class="btn btn-info btn-xs">
                                            <i class="fa fa-fw fa-eye"></i> visualizar
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {!! str_replace('/?', '?', $pedidos->render()) !!}
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Nenhum pedido ainda cadastrado.</h5>
                                <br>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop
