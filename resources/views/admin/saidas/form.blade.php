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
                {!!Form::label('solicitante_id', 'Solicitante', array('class'=>'control-label'))!!}
                {!!Form::select('solicitante_id', $users, null, ['required' => 'required', 'class'=>'form-control', 'id'=>'natureza_op'])!!}
            </div>
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

    <br>

    <div class='new-material'>

    </div>

</div>

