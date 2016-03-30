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
                                <th>Qtd. entregue</th>
                                <th>Qtd. devolvida</th>
                                <th>Quant</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($saida->subMateriais as $subMaterial)
                            <tr>
                                <td style="width: 10%">{{$subMaterial->material->codigo}}</td>
                                <td style="width: 70%">{{$subMaterial->material->descricao}}</td>
                                <td style="width: 5%">{{$subMaterial->pivot->quant}}</td>
                                <td style="width: 5%">{{$subMaterial->present()->getQtdDevolvida()}}</td>
                                <td style="width: 10%">{!!Form::number("qtds[$subMaterial->id]", null, array('class'=>'form-control', 'id' => 'qtds[$subMaterial->id]', 'required' => 'required', 'min' => '0', 'max'=>$subMaterial->present()->getQtdMaxDevolucao() ,$subMaterial->present()->getQtdMaxDevolucao() > 0 ? '' : 'disabled'))!!}</td>
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
</div>

