@extends('template/header')
@section('menu-pedidos')
<li>
    <a href="{{route('pedidos.pedido-atual')}}">Pedido atual ({{Cart::count(false)}})</a>    
</li>
@stop