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
                {!!Form::label('codigo', 'Código', array('class'=>'control-label'))!!}
                {!!Form::number('codigo', null, array('class'=>'form-control', 'id' => 'codigo', 'required' => 'required'))!!}
            </div>

            <div class='col-md-9'>
                {!!Form::label('descricao', 'Descrição', array('class'=>'control-label'))!!}
                {!!Form::text('descricao', null, array('class'=>'form-control', 'id' => 'descricao', 'placeholder'=>'Descreva o nome principal do material seguido das dimensões ou quantidades, e demais especificações.', 'required' => 'required'))!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-2'>
                {!!Form::label('unidade_id', 'Unidade', array('class'=>'control-label'))!!}
                {!!Form::select('unidade_id', $unidades, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'unidade_id'])!!}
            </div>
            <div class='col-md-5'>
                {!!Form::label('marca', 'Marca', array('class'=>'control-label'))!!}
                {!!Form::text('marca', null, array('class'=>'form-control', 'id' => 'marca'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('qtd_min', 'Quantidade mínima', array('class'=>'control-label'))!!}
                {!!Form::number('qtd_min', null, array('class'=>'form-control', 'id' => 'qtd_1', 'min'=> '0', 'required' => 'required'))!!}
            </div>
            <div class='col-md-3' >
                {!!Form::label('disponivel', 'Disponibilidade', array('class'=>'control-label'))!!}
                {!!Form::select('disponivel', $disponibilidade, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'disponivel'])!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <div class="col-md-4">
                {!!Form::label('imagem', 'Imagem', array('class'=>'control-label'))!!}
                {!!Form::file('imagem', null)!!}
            </div>
        </div>
    </div>
    @if(isset($material) && $material->imagem != '')
    <br>
    <div class='row'>
        <div class='col-md-6'>
            <b>Imagem atual:</b><br>
            <img src="{{asset($material->present()->getThumbUrl($material->imagem, 400,400))}}">
        </div>
    </div>
    <br>
    @endif
</div>

