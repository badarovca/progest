@extends('admin.empenhos.form')

@section('lista-materiais')
@foreach($empenho->materiais as $material)
<tr>
    <td style='width: 15%'>{{$material->id}}</td>
    <td style='width: 50%'>{{$material->descricao}}</td>
    <td style='width: 10%'>{!!Form::number("qtds[$material->id]", $material->pivot->quant, array('class'=>'form-control', 'id' => 'qtds[$material->id]', 'required' => 'required'))!!}</td>
    <td style='width: 10%'>{!!Form::text("valores_materiais[$material->id]", number_format($material->pivot->vl_total, 2, ',', '.'), array('class'=>'form-control valor valor-total-material', 'id' => 'valores_materiais[$material->id]', 'required' => 'required'))!!}</td>
    <td style='width: 10%'>{!!Form::text("valores_materiais[$material->id]", $material->present()->getValorUn, array('class'=>'form-control valor', 'id' => 'valores_materiais[$material->id]', 'required' => 'required'))!!}</td>
    <td style='width: 5%'><a href='javascript:void(0)' class='btn btn-danger btn-xs remove-material' ><i class='fa fa-fw fa-remove'></i> remover</a></td>
</tr>
@endforeach

@stop