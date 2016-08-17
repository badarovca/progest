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
    <div class='row'>
        <h4>Material: {!!$submaterial->Material->descricao!!} - Empenho: {!!$submaterial->Empenho->numero !!}</h4>
    </div>
    <br>
    <div class="row">
        <div class="form-group">
            <div class="col-md-4">
                {!!Form::label('vencimento', 'Vencimento', array('class'=>'control-label'))!!}
                {!!Form::date('vencimento', null, array('class'=>'form-control', 'id' => 'dt_vencimento'))!!}
            </div>
            <div class='col-md-5'>
                {!!Form::label('sub_item_id', 'Subitem', array('class'=>'control-label'))!!}
                {!!Form::select('sub_item_id', $subitens, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'sub_item_id', 'disabled'=>'disabled'])!!}
            </div>
        </div>
    </div>
</div>

