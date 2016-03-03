<div class='form-group'> 
    <div class='col-md-12'>
        {!!Form::label('name', 'Nome', array('class'=>'control-label'))!!}
        {!!Form::text('name', null, array('class'=>'form-control', 'id' => 'name', 'required' => 'required'))!!}
    </div>
    <div class='checkbox col-md-4' >
        <label>
            {!!Form::checkbox('status', null)!!} Ativado
        </label>
    </div>
</div>


