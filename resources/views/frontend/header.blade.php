@extends('template/header')
@section('toogle-button')

@stop

@section('menu-pedidos')

@if (Cart::count(false))
<li>
    <a href="{{route('pedidos.pedido-atual')}}">Finalizar pedido <span class="label label-danger">{{Cart::count(false)}}</span></a>       
</li>
@endif

<li>
    <a href="{{route('pedidos.lista-pedidos')}}">Meus pedidos</a> 
</li>
<li>
    <a href="{{route('pedidos.consumo-do-campus')}}">Consumo do campus</a> 
</li>
<li>
    <a href="{{url('/ajuda')}}" target="_blank">Ajuda</a> 
</li>
@stop

@if (Cart::count(false))
@section('botoes-usuario')
<li class="user-footer">
    <div class="pull-left">
        <a href="{{ route('redefinir-senha') }}" class="btn btn-default btn-flat">Alterar Senha</a>
    </div>
    <div class="pull-right">
        <a href="#" class="btn btn-default btn-flat" data-toggle="modal" data-target="#confirmaSaida">Sair</a>
    </div>
</li>
@overwrite
@endif

<!-- Modal para confirmação de logout caso haja um pedido em aberto -->
<div id="confirmaSaida" class="modal modal-success fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Pedido ainda não finalizado.</h4>
            </div>
            <div class="modal-body">
                <p>Você possui um pedido ainda não finalizado. Tem certeza de que deseja sair?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancelar</button>
                <div class="pull-right">
                    <a href="{{ url('/auth/logout') }}" class="btn btn-outline">Sair</a>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->