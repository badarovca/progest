@if ($errors->any())
<div class="container-fluid">
    <ul class="alert alert-error">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<fieldset>
    <legend>Materiais</legend>
    <div class="container-fluid">
        <div class="row row-add-material">
            <div class='col-md-7'>
                <div class='form-group saida-material'>
                    {!!Form::label('material_id', 'Materiais', array('class'=>'control-label'))!!}
                    {!!Form::select('null', $materiais, null, ['class'=>'form-control saida-material-select2', 'id'=>'material_id'])!!}
                </div>
            </div>
            <div class='col-md-2'>
                <div class='form-group'>
                    {!!Form::label('quant', 'Quant', array('class'=>'control-label'))!!}
                    {!!Form::number(null, null, ['class'=>'form-control', 'quant'=>'quant', 'id'=>'qtd-material-saida', 'min' => '0'])!!}
                </div>
            </div>
            <div class='col-md-3'>
                <div class='form-group'>
                    {!!Form::button('Adicionar', ['class'=>'btn btn-default add-material', 'id'=>'add-material-saida'])!!}
                </div>
            </div>
        </div>
        <br>
    </div>
</fieldset>
