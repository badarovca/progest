<script></script>
<div class="container-fluid">
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-6'>
                {!!Form::label('numero', 'Número', array('class'=>'control-label'))!!}
                {!!Form::text('numero', null, array('class'=>'form-control', 'id' => 'numero', 'required' => 'required'))!!}
            </div>

            <div class='col-md-6'>
                {!!Form::label('tipo', 'Tipo', array('class'=>'control-label'))!!}
                {!!Form::select('tipo', ['ORDINÁRIO'=>'ORDINÁRIO', 'ESTIMATIVO' => 'ESTIMATIVO', 'GLOBAL' => 'GLOBAL'], null, ['required' => 'required', 'class'=>'form-control', 'id'=>'fornecedor_id'])!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-6'>
                {!!Form::label('fornecedor_id', 'Fornecedor', array('class'=>'control-label'))!!}
                {!!Form::select('fornecedor_id', $fornecedores, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'fornecedor_id'])!!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class='form-group'>
            <div class='col-md-2'>
                {!!Form::label('cat_despesa', 'Categoria da despesa', array('class'=>'control-label'))!!}
                {!!Form::text('cat_despesa', null, array('class'=>'form-control', 'id' => 'cat_despesa', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('mod_aplicacao', 'Mod. aplicação', array('class'=>'control-label'))!!}
                {!!Form::text('mod_aplicacao', null, array('class'=>'form-control', 'id' => 'mod_aplicacao', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('el_consumo', 'Elemento de consumo', array('class'=>'control-label'))!!}
                {!!Form::text('el_consumo', null, array('class'=>'form-control', 'id' => 'el_consumo', 'required' => 'required'))!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-6'>
                {!!Form::label('mod_licitacao', 'Modalidade da licitação', array('class'=>'control-label'))!!}
                {!!Form::text('mod_licitacao', null, array('class'=>'form-control', 'id' => 'mod_licitacao', 'required' => 'required'))!!}
            </div>
            <div class='col-md-6'>
                {!!Form::label('num_processo', 'Nº do processo', array('class'=>'control-label'))!!}
                {!!Form::text('num_processo', null, array('class'=>'form-control', 'id' => 'num_processo', 'required' => 'required'))!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-12'>
                {!!Form::label('solicitantes', 'Solicitantes', array('class'=>'control-label'))!!}
                {!!Form::text('solicitantes', null, array('class'=>'form-control', 'id' => 'solicitantes', 'required' => 'required'))!!}
            </div>
        </div>
    </div>
    <br>
    <div class='new-material'>

    </div>
    <div class='row'>
        <a id='add-material' class='col-md-3 text-right pull-right' href="javascript:void(0)">Novo material</a>

    </div>
    <br>
</div>

