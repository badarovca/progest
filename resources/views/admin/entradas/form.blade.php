@if ($errors->any())
<div class="container-fluid">
    <ul class="alert alert-error">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<script></script>
<div class="container-fluid">
    <div class="row">
        <div class='form-group'> 
            <div class='col-md-3'>
                {!!Form::label('num_nf', 'Número NF', array('class'=>'control-label'))!!}
                {!!Form::text('num_nf', null, array('class'=>'form-control', 'id' => 'num_nf', 'required' => 'required'))!!}
            </div>

            <div class='col-md-3'>
                {!!Form::label('numero_empenho', 'Empenho', array('class'=>'control-label'))!!}
                {!!Form::text('numero_empenho', $empenho->numero, array('class'=>'form-control', 'id' => 'numero_empenho', 'readonly'))!!}
            </div>

            <div class='col-md-6'>
                {!!Form::label('cod_chave', 'Código chave', array('class'=>'control-label'))!!}
                {!!Form::text('cod_chave', null, array('class'=>'form-control', 'id' => 'cod_chave', 'required' => 'required'))!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-4'>
                {!!Form::label('natureza_op', 'Natureza da operação', array('class'=>'control-label'))!!}
                {!!Form::select('natureza_op', ['Venda de Mercadoria' => 'Venda de Mercadoria', 'Doação' => 'Doação'], null, ['required' => 'required', 'class'=>'form-control', 'id'=>'natureza_op'])!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('dt_emissao', 'Data emissão', array('class'=>'control-label'))!!}
                {!!Form::date('dt_emissao', null, array('class'=>'form-control', 'id' => 'dt_emissao', 'required' => 'required'))!!}
            </div>
            <div class='col-md-2'>
                {!!Form::label('dt_recebimento', 'Data recebimento', array('class'=>'control-label'))!!}
                {!!Form::date('dt_recebimento', null, array('class'=>'form-control', 'id' => 'dt_recebimento', 'required' => 'required'))!!}
            </div>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Materiais</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Descricao</th>
                                <th>Qtd. restante</th>
                                <th>Qtd. entregue</th>
                                <th>Quant</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($empenho->subMateriais as $subMaterial)
                            <tr>
                                <td style="width: 10%">{{$subMaterial->material->codigo}}</td>
                                <td style="width: 70%">{{$subMaterial->material->descricao}}</td>
                                <td style="width: 5%">{{$subMaterial->present()->getQtdRestante()}}</td>
                                <td style="width: 5%">{{$subMaterial->present()->getQtdEntregue()}}</td>
                                <td style="width: 10%">{!!Form::number("qtds[$subMaterial->id]", null, array('class'=>'form-control', 'id' => 'qtds[$subMaterial->id]', 'required' => 'required', 'min' => '0', 'max'=>$subMaterial->present()->getQtdRestante() ,$subMaterial->present()->getQtdRestante() > 0 ? '' : 'disabled'))!!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>

