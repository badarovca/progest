<div class='form-group'> 
    <div class='col-md-6'>
        {!!Form::label('name', 'Nome', array('class'=>'control-label'))!!}
        {!!Form::text('name', null, array('class'=>'form-control', 'id' => 'name', 'required' => 'required'))!!}
    </div>

    <div class='col-md-6'>
        {!!Form::label('siape', 'SIAPE', array('class'=>'control-label'))!!}
        {!!Form::text('siape', null, array('class'=>'form-control', 'id' => 'siape', 'required' => 'required'))!!}
    </div>
</div>

<div class='form-group'>
    <div class='col-md-4'>
        {!!Form::label('telefone', 'Telefone', array('class'=>'control-label'))!!}
        {!!Form::text('telefone', null, array('class'=>'form-control', 'id' => 'telefone'))!!}
    </div>
    <div class='col-md-8'>
        {!!Form::label('email', 'E-mail', array('class'=>'control-label'))!!}
        {!!Form::email('email', null, array('class'=>'form-control', 'id' => 'email', 'required' => 'required'))!!}
    </div>
</div>

<div class='form-group'>
    <div class='col-md-6'>
        {!!Form::label('setor', 'Setor', array('class'=>'control-label'))!!}
        {!!Form::select('setor_id', $setores, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'setor_id'])!!}
    </div>
    <div class='col-md-6'>
        {!!Form::label('role', 'Permissão', array('class'=>'control-label'))!!}
        {!!Form::select('role', $roles, null, ['required' => 'required', 'class'=>'form-control'])!!}
    </div>
</div>

<div class='form-group'>
    <div class='checkbox col-md-4' >
        <label>
            {!!Form::checkbox('habilitado', null)!!} Habilitado
        </label>
    </div>
</div>

