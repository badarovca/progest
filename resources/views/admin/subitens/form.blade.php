<div class="container-fluid">
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-12'>
                {!!Form::label('material_consumo', 'Material de Consumo', array('class'=>'control-label'))!!}
                {!!Form::text('material_consumo', null, array('class'=>'form-control', 'id' => 'material_consumo', 'required' => 'required'))!!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class='checkbox col-md-4' >
            <label>
                {!!Form::checkbox('status', null)!!} Ativado
            </label>
        </div>
    </div>
</div>
