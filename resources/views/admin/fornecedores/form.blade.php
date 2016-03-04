<div class="container-fluid">
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-6'>
                {!!Form::label('fantasia', 'Nome Fantasia', array('class'=>'control-label'))!!}
                {!!Form::text('fantasia', null, array('class'=>'form-control', 'id' => 'fantasia', 'required' => 'required'))!!}
            </div>

            <div class='col-md-6'>
                {!!Form::label('razao', 'Razão Social', array('class'=>'control-label'))!!}
                {!!Form::text('razao', null, array('class'=>'form-control', 'id' => 'razao', 'required' => 'required'))!!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class='form-group'>
            <div class='col-md-12'>
                {!!Form::label('endereco', 'Endereço', array('class'=>'control-label'))!!}
                {!!Form::text('endereco', null, array('class'=>'form-control', 'id' => 'endereco', 'required' => 'required'))!!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class='form-group'>
            <div class='col-md-7'>
                {!!Form::label('email', 'Email', array('class'=>'control-label'))!!}
                {!!Form::email('email', null, array('class'=>'form-control', 'id' => 'email', 'required' => 'required'))!!}
            </div>
            <div class='col-md-5'>
                {!!Form::label('cnpj', 'CNPJ', array('class'=>'control-label'))!!}
                {!!Form::text('cnpj', null, array('class'=>'form-control', 'id' => 'cnpj', 'required' => 'required'))!!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class='form-group'>
            <div class='col-md-6'>
                {!!Form::label('telefone1', 'Telefone 1', array('class'=>'control-label'))!!}
                {!!Form::text('telefone1', null, array('class'=>'form-control', 'id' => 'telefone1', 'required' => 'required'))!!}
            </div>
            <div class='col-md-6'>
                {!!Form::label('telefone2', 'Telefone 2', array('class'=>'control-label'))!!}
                {!!Form::text('telefone2', null, array('class'=>'form-control', 'id' => 'telefone2'))!!}
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




