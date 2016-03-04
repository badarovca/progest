@extends('template/header')
@section('toogle-button')

@stop
@section('menu-pedidos')
<li>
    <a href="{{route('pedidos.pedido-atual')}}">Pedido atual ({{Cart::count(false)}})</a>    
</li>
@stop