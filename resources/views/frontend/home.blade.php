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
                @if($materiais->count() > 0)
                <h4 class='title'>Busca por: <b>{{$busca['busca']}}</b> ({{$materiais->count()}} resultado(s))</h4> 
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
                            <img src="{{ asset("img/material.png") }}" alt="{{$material->descricao}}"/>
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

        @endforeach
        <div class="row">
            <div class="col-md-8 text-center">
                {!! str_replace('/?', '?', $materiais->render()) !!}
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop