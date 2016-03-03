<div class="container-fluid">
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-6'>
                {!!Form::label('name', 'Nome', array('class'=>'control-label'))!!}
                {!!Form::text('name', null, array('class'=>'form-control', 'id' => 'name', 'required' => 'required'))!!}
            </div>
            <div class='col-md-6'>
                {!!Form::label('coordenacao_id', 'Coordenação', array('class'=>'control-label'))!!}
                {!!Form::select('coordenacao_id', $coordenacoes, null, ['required' => 'required', 'class' => 'form-control', 'id'=>'coordenacao_id'])!!}
            </div>
        </div>
    </div>
    <br>
</div>
