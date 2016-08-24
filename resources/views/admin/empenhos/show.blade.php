@extends('admin.admin_template')

@section('content')

<!--Content Wrapper. Contains page content -->
<div class = "content-wrapper">
    <!--Content Header (Page header) -->
    <section class = "content-header">
        <h1>
            {!! $page_title or "Visualização de empenho" !!}
            <small>{!! $page_description or null !!}</small>
        </h1>
    </section>

    <!--Main content -->
    <section class = "content">
        <div class="container-fluid">
            <div class="row">
                <div class='form-group'> 
                    <div class='col-md-6'>
                        {!!Form::label('numero', 'Número', array('class'=>'control-label'))!!}
                        {!!Form::text('numero', $empenho->numero, array('class'=>'form-control', 'id' => 'numero', 'disabled' =>'true'))!!}
                    </div>

                    <div class='col-md-6'>
                        {!!Form::label('tipo', 'Tipo', array('class'=>'control-label'))!!}
                        {!!Form::text('tipo', $empenho->tipo, array('class'=>'form-control', 'id' => 'numero', 'disabled' =>'true'))!!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class='form-group'>
                    <div class='col-md-6'>
                        {!!Form::label('fornecedor_id', 'Fornecedor', array('class'=>'control-label'))!!}
                        {!!Form::text('fornecedor_id', $empenho->fornecedor->fantasia, array('class'=>'form-control', 'id' => 'numero', 'disabled' =>'true'))!!}
                    </div>
                    <div class='col-md-2'>
                        {!!Form::label('cat_despesa', 'Categoria da despesa', array('class'=>'control-label'))!!}
                        {!!Form::text('cat_despesa', $empenho->cat_despesa, array('class'=>'form-control', 'id' => 'cat_despesa', 'disabled' =>'true'))!!}
                    </div>
                    <div class='col-md-4'>
                        {!!Form::label('el_consumo', 'Elemento de consumo', array('class'=>'control-label'))!!}
                        {!!Form::text('el_consumo', $empenho->el_consumo, array('class'=>'form-control', 'id' => 'cat_despesa', 'disabled' =>'true'))!!} 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class='form-group'>
                    <div class='col-md-6'>
                        {!!Form::label('mod_licitacao', 'Modalidade da licitação', array('class'=>'control-label'))!!}
                        {!!Form::text('mod_licitacao', $empenho->mod_licitacao, array('class'=>'form-control', 'id' => 'mod_licitacao', 'disabled' =>'true'))!!}
                    </div>
                    <div class='col-md-6'>
                        {!!Form::label('num_processo', 'Nº do processo', array('class'=>'control-label'))!!}
                        {!!Form::text('num_processo', $empenho->num_processo, array('class'=>'form-control', 'id' => 'num_processo', 'disabled' =>'true'))!!}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class='form-group'>
                    <div class='col-md-12'>
                        {!!Form::label('solicitante_id', 'Solicitante', array('class'=>'control-label'))!!}
                        {!!Form::text('solicitante_id', $empenho->solicitante->name, array('class'=>'form-control', 'id' => 'solicitante_id', 'disabled' =>'true'))!!}
                    </div>
                </div>
            </div>
            <br>
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
                                        <th>ID</th>
                                        <th>Descricao</th>
                                        <th>Qtd. restante</th>
                                        <th>Qtd. entregue</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id='lista-materiais'>
                                    @foreach($empenho->subMateriais as $subMaterial)
                                    <tr>
                                        <td style="width: 10%">{{$subMaterial->material->codigo}}</td>
                                        <td style="width: 70%">{{$subMaterial->material->descricao}}</td>
                                        <td style="width: 5%">{{$subMaterial->present()->getQtdRestante()}}</td>
                                        <td style="width: 5%">{{$subMaterial->present()->getQtdEntregue()}}</td>
                                        <td style="width: 10%">{{$subMaterial->qtd_solicitada}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
        <!--                        <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-right">Total</td>
                                        <th id="valor-total-empenho" >00,00</td>
                                    </tr>
                                </tfoot>-->
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
            </div>
            <br>
            <div class='new-material'>

            </div>
            <br>

            <div class="row">
                <div class='col-md-3 col-md-offset-9 text-right'>
                    <b>Total: <span>{{$empenho->present()->getValorTotal()}}</span></b>
                </div>
            </div>
        </div>
    </section><!--/.content -->
</div><!--/.content-wrapper -->
@stop