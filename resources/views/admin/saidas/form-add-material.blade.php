<tr class='item-saida-material'>
    <td style='width: 15%'>{{$material->id}}</td>
    <td style='width: 65%'>{{$material->descricao}}</td>
    <td style='width: 10%'>
        {!!Form::text("qtds[$material->id]", $qtd, array('class'=>'form-control', 'id' => "qtds[$material->id]", 'required' => 'required', 'readonly' => 'true'))!!}
    </td>
    <td>
        <a href="javascript:void(0)" class="btn btn-danger btn-xs remove-material">
            <i class="fa fa-fw fa-remove "></i> remover
        </a>
    </td>
</tr>