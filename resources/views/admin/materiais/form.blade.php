<div class="container-fluid">
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-3'>
                {!!Form::label('codigo', 'Código', array('class'=>'control-label'))!!}
                {!!Form::text('codigo', null, array('class'=>'form-control', 'id' => 'codigo', 'required' => 'required'))!!}
            </div>

            <div class='col-md-9'>
                {!!Form::label('descricao', 'Descrição', array('class'=>'control-label'))!!}
                {!!Form::text('descricao', null, array('class'=>'form-control', 'id' => 'descricao', 'required' => 'required'))!!}
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
                {!!Form::text('marca', null, array('class'=>'form-control', 'id' => 'marca', 'required' => 'required'))!!}
            </div>
            <div class='col-md-5'>
                {!!Form::label('sub_item_id', 'Subitens', array('class'=>'control-label'))!!}
                {!!Form::select('sub_item_id', $subitens, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'sub_item_id'])!!}
            </div>
        </div>
    </div>


    <div class="row">
        <div class='form-group'>
            <div class='col-md-2'>
                {!!Form::label('qtd_1', 'Qtd estoque 1', array('class'=>'control-label'))!!}
                {!!Form::text('qtd_1', null, array('class'=>'form-control', 'id' => 'qtd_1', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('qtd_2', 'Qtd estoque 2', array('class'=>'control-label'))!!}
                {!!Form::text('qtd_2', null, array('class'=>'form-control', 'id' => 'qtd_2', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('qtd_3', 'Qtd estoque 3', array('class'=>'control-label'))!!}
                {!!Form::text('qtd_3', null, array('class'=>'form-control', 'id' => 'qtd_3', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('qtd_4', 'Qtd estoque 4', array('class'=>'control-label'))!!}
                {!!Form::text('qtd_4', null, array('class'=>'form-control', 'id' => 'qtd_4', 'required' => 'required'))!!}
            </div>
        </div>
        <div class='checkbox col-md-4' >
            <div class="checkbox">
                <label>
                    {!!Form::checkbox('disponivel', null)!!} Disponível
                </label>
            </div>
        </div>
    </div>
</div>

