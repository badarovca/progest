<script></script>
<div class="container-fluid">
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
                                <th>ID</th>
                                <th>Descricao</th>
                                <th>Quant</th>
                            </tr>
                        </thead>
                        <tbody id='lista-materiais'>
                            @if (isset($old_materiais))
                            @foreach ($old_materiais as $material)
                            <tr>
                                <td style='width: 15%'>{{$material->id}}</td>
                                <td style='width: 65%'>{{$material->descricao}}</td>
                                <td style='width: 10%'>
                                    {!!Form::text("qtds[$material->id]", $qtds[$material->id], array('class'=>'form-control', 'id' => "qtds[$material->id]", 'required' => 'required', 'readonly' => 'true'))!!}
                            </tr>
                            @endforeach
                            
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-12'>
                {!!Form::label('obs', 'Observação', array('class'=>'control-label'))!!}
                {!!Form::textarea('obs', null, array('class'=>'form-control', 'id' => 'obs', 'required' => 'required', 'rows'=>'3'))!!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class='form-group'>
            <div class='col-md-6'>
                {!!Form::label('email', 'Email do solicitante', array('class'=>'control-label'))!!}
                {!!Form::text('email', null, ['required' => 'required', 'class'=>'form-control', 'id'=>'email'])!!}
            </div>
            <div class='col-md-6'>
                {!!Form::label('password', 'Senha', array('class'=>'control-label'))!!}
                {!!Form::password('password', ['required' => 'required', 'class'=>'form-control', 'id'=>'password'])!!}
            </div>
        </div>
    </div>
    <br>

    <div class='new-material'>

    </div>

</div>

