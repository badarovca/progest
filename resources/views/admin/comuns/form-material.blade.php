<fieldset>
    <legend>Materiais</legend>
    <div class="container-fluid">
        <div class="row row-add-material">
            <div class='col-md-7'>
                <div class='form-group'>
                    {!!Form::label('material_id', 'Materiais', array('class'=>'control-label'))!!}
                    {!!Form::select('null', $materiais, null, ['class'=>'form-control material-select2', 'id'=>'material_id'])!!}
                </div>
            </div>
            <div class='col-md-2'>
                <div class='form-group'>
                    {!!Form::label('quant', 'Quant', array('class'=>'control-label'))!!}
                    {!!Form::number(null, null, ['class'=>'form-control', 'quant'=>'quant', 'id'=>'qtd-material'])!!}
                </div>
            </div>
            <div class='col-md-3'>
                <div class='form-group'>
                    {!!Form::button('Adicionar', ['class'=>'btn btn-default add-material'])!!}
                </div>
            </div>
        </div>
        <br>
    </div>
</fieldset>
