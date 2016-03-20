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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Materiais solicitados</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Cód</th>
                                <th>Descricao</th>
                                <th>Qtd. solicitada</th>
                                <th>Qtd. disponível</th>
                                <th>Quant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedido->materiais as $material)
                            <tr>
                                <td style="width: 10%">{{$material->codigo}}</td>
                                <td style="width: 70%">{{$material->descricao}}</td>
                                <td style="width: 5%">{{($material->pivot->quant)}}</td>
                                <td style="width: 5%">{{$material->qtd_1}}</td>
                                <td style="width: 10%">{!!Form::number("qtds[$material->id]", null, array('class'=>'form-control', 'id' => 'qtd[$material->id]', 'required' => 'required', 'min' => '0', 'max'=>$material->qtd_1, $material->qtd_1 > 0 ? '' : 'disabled'))!!}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <p><b>Justificativa:</b> {{$pedido->obs}}</p>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>
    
    {!!Form::hidden('solicitante_id', $pedido->solicitante->id);!!}
    {!!Form::hidden("pedido[$pedido->id]", "Resolvido");!!}
    <div class="row">
        <div class='form-group'>
            <div class='col-md-12'>
                {!!Form::label('obs', 'Obs', array('class'=>'control-label'))!!}
                {!!Form::textarea('obs', null, array('class'=>'form-control', 'id' => 'obs', 'required' => 'required', 'rows'=>'3'))!!}
            </div>
        </div>
    </div>
</div>

