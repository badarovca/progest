@extends('frontend.frontend_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header container">
        @include('template.alerts')
        <h1>
            {{ "Busca por materiais" }}
        </h1>
    </section>

    <!--Main content -->
    <section class = "content container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {!! Form::open(array('route' => 'pedidos.busca-materiais', 'method'=>'GET')) !!}
                <div class="input-group">
                    {!!Form::text('busca', null, array('class'=>'form-control', 'id' => 'busca', 'required' => 'required', 'placeholder'=>'Pesquisar...'))!!}
                    <span class="input-group-btn">
                        {!! Form::submit('Ir', ['class'=>'btn btn-default'])!!}
                    </span>
                </div><!-- /input-group -->
                {!! Form::close() !!}

            </div>
        </div>
        <br>
        @if(isset($busca))
        <div class='row'>
            <div class='col-md-12'>
                @if($materiais->total() > 0)
                <h4 class='title'>Busca por: <b>{{$busca['busca']}}</b> ({{$materiais->total()}} resultado(s))</h4> 
                @else
                <h4 class='title'>Nenhum resultado encontrado.</h4>
                @endif
            </div>
        </div>
        @endif
        <!--Your Page Content Here -->
        @foreach($materiais as $material)
        <div class="row row-eq-height">
            <div class="col-md-8">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="image inline-block">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#imagem{{$material->id}}"><img src="{{ $material->imagem != '' ? asset($material->present()->getThumbUrl($material->imagem, '100', '100')) : asset("img/material.png")}}" width="100" height="100"alt="{{$material->descricao}}"/></a>
                        </div>
                        <div class="description inline-block">
                            <div><span><b>Descrição: </b></span> {{$material->descricao}}</div>
                            <div><span><b>Unidade: </b></span> {{$material->unidade->name}}</div>
                            <div><span><b>Marca: </b></span> {{$material->marca}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-2'>
                <div class="box box-solid">
                    <div class="box-body">
                        {!! Form::open(array('route' => 'pedidos.add-material')) !!}
                        <div class='form-group'>
                            {!! Form::label('qtd[$material->id]', 'Quantidade')!!}
                            {!!Form::number("qtd[$material->id]", null, array('class'=>'form-control', 'id' => "qtd[$material->id]", 'required' => 'required', 'min'=>'0'))!!}
                        </div>
                        {!! Form::submit('Adicionar ao pedido', ['class'=>'btn btn-default'])!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="imagem{{$material->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">{{$material->descricao}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class='text-center center-block'>
                            <img src="{{ $material->imagem != '' ? asset($material->present()->getThumbUrl($material->imagem, '400', '400')) : asset("img/material.png")}}"alt="{{$material->descricao}}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <div class="row">
            <div class="col-md-8 text-center">
                @if (!isset($busca))
                {!! str_replace('/?', '?', $materiais->render()) !!}
                @else
                {!! str_replace('/?', '?', $materiais->appends($busca)->render()) !!}
                @endif
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop