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
    <a href="{{url('/ajuda')}}" target="_blank">Ajuda</a> 
</li>
@stop