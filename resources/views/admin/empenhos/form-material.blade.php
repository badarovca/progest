<fieldset>
    <div class="row">
        <div class="col-md-3 col-md-offset-9">
            <a href="javascript:void(0)" class="btn btn-danger btn-xs pull-right remove-form-material">
                <i class="fa fa-fw fa-remove"></i> cancelar
            </a>
        </div>
    </div>
    <legend>Novo material</legend>
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-3'>
                {!!Form::label('codigo[]', 'Código', array('class'=>'control-label'))!!}
                {!!Form::number('codigo[]', null, array('class'=>'form-control codigo-material', 'id' => 'codigo[]'))!!}
            </div>

            <div class='col-md-9'>
                {!!Form::label('descricao[]', 'Descrição', array('class'=>'control-label'))!!}
                {!!Form::text('descricao[]', null, array('class'=>'form-control', 'id' => 'descricao[]', 'placeholder'=>'Descreva o nome principal do material seguido das dimensões ou quantidades, e demais especificações.','required' => 'required'))!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-2'>
                {!!Form::label('unidade_id[]', 'Unidade', array('class'=>'control-label'))!!}
                {!!Form::select('unidade_id[]', $unidades, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'unidade_id[]'])!!}
            </div>
            <div class='col-md-5'>
                {!!Form::label('marca[]', 'Marca', array('class'=>'control-label'))!!}
                {!!Form::text('marca[]', null, array('class'=>'form-control', 'id' => 'marca[]', 'required' => 'required'))!!}
            </div>
            <div class='col-md-5'>
                {!!Form::label('sub_item_id[]', 'Subitens', array('class'=>'control-label'))!!}
                {!!Form::select('sub_item_id[]', $subitens, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'sub_item_id[]'])!!}
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="form-group">
            <div class="col-md-4">
                {!!Form::label('vencimento[]', 'Vencimento', array('class'=>'control-label'))!!}
                {!!Form::date('vencimento[]', null, array('class'=>'form-control', 'id' => 'vencimento[]'))!!}
            </div>
            <div class="col-md-4">
                {!!Form::label('imagem[]', 'Imagem', array('class'=>'control-label'))!!}
                {!!Form::file('imagem[]', null)!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-3'>
                {!!Form::label('vl_total[]', 'Valor total', array('class'=>'control-label'))!!}
                {!!Form::text('vl_total[]', null, array('class'=>'form-control valor valor-total-material', 'id' => 'vl_total[]', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('qtd_min[]', 'Quantidade mínima', array('class'=>'control-label'))!!}
                {!!Form::number('qtd_min[]', null, array('class'=>'form-control', 'id' => 'qtd_min[]', 'min'=> '0', 'required' => 'required'))!!}
            </div>
            <div class='col-md-3'>
                {!!Form::label('qtd_solicitada[]', 'Quantidade', array('class'=>'control-label'))!!}
                {!!Form::text('qtd_solicitada[]', null, array('class'=>'form-control', 'id' => 'qtd_solicitada[]', 'required' => 'required'))!!}
            </div>
        </div>
    </div>

</fieldset>
