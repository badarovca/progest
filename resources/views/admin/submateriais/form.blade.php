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
        <div class="form-group">
            <div class="col-md-4">
                {!!Form::label('vencimento', 'Vencimento', array('class'=>'control-label'))!!}
                {!!Form::date('vencimento', null, array('class'=>'form-control', 'id' => 'dt_vencimento'))!!}
            </div>
        </div>
    </div>
</div>

