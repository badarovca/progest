<fieldset>
    <legend>Materiais</legend>
<!--    <div class="container-fluid">-->
        <div class="row row-add-material">
            <div class='col-md-4'>
                <div class='form-group'>
                    {!!Form::label('material_id', 'Materiais', array('class'=>'control-label'))!!}
                    {!!Form::select(null, $materiais, null, ['class'=>'form-control material-select2', 'id'=>'material_id'])!!}
                </div>
            </div>
            <div class='col-md-1'>
                <div class='form-group'>
                    {!!Form::label('quant', 'Quant', array('class'=>'control-label'))!!}
                    {!!Form::number(null, null, ['min'=>'0', 'class'=>'form-control', 'quant'=>'quant', 'id'=>'qtd-material'])!!}
                </div>
            </div>
            <div class='col-md-2'>
                <div class='form-group'>
                    {!!Form::label('valor', 'Valor total', array('class'=>'control-label'))!!}
                    {!!Form::text(null, null, ['class'=>'form-control valor', 'valor'=>'valor', 'id'=>'valor-material'])!!}
                </div>
            </div>
            <div class='col-md-2'>
                <div class='form-group'>
                    {!!Form::label('vencimento', 'Vencimento', array('class'=>'control-label'))!!}
                {!!Form::date('vencimento', null, array('class'=>'form-control', 'id' => 'vencimento'))!!}
                </div>
            </div>
            <div class='col-md-1'>
                <div class='form-group'>
                    {!!Form::button('Adicionar', ['class'=>'btn btn-default add-material', 'id'=>"add-material-empenho"])!!}
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <a id='add-material' class='col-md-3 text-right pull-right' href="javascript:void(0)"><button class="btn btn-sm btn-warning">Novo material</button></a>
                </div>
            </div>
        </div>
        <br>
    <!--</div>-->
</fieldset>
