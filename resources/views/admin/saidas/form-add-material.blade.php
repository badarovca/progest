<tr>
    <td style='width: 15%'>{{$material->id}}</td>
    <td style='width: 65%'>{{$material->descricao}}</td>
    <td style='width: 10%'>
        {!!Form::text("qtds[$material->id]", $qtd, array('class'=>'form-control', 'id' => "qtds[$material->id]", 'required' => 'required', 'readonly' => 'true'))!!}
</tr>