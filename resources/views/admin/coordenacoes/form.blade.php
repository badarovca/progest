@if ($errors->any())
<div class="container-fluid">
    <ul class="alert alert-error">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-3'>
                {!!Form::label('name', 'Nome', array('class'=>'control-label'))!!}
                {!!Form::text('name', null, array('class'=>'form-control', 'id' => 'name', 'required' => 'required'))!!}
            </div>
            <div class='col-md-3'>
                {!!Form::label('coordenador', 'Coordenador', array('class'=>'control-label'))!!}
                {!!Form::text('coordenador', null, array('class'=>'form-control', 'id' => 'coordenador', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('telefone', 'Telefone', array('class'=>'control-label'))!!}
                {!!Form::text('telefone', null, array('class'=>'form-control', 'id' => 'telefone', 'required' => 'required'))!!}
            </div>
            <div class='col-md-4'>
                {!!Form::label('email', 'Email', array('class'=>'control-label'))!!}
                {!!Form::email('email', null, array('class'=>'form-control', 'id' => 'email', 'required' => 'required'))!!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <div class='checkbox col-md-3' >
                <label>
                    {!!Form::checkbox('status', null)!!} Ativado
                </label>
            </div>
        </div>
    </div>
</div>

