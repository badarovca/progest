@extends('admin.empenhos.form')

@section('lista-materiais')
@foreach($empenho->materiais as $material)
<tr>
    <td style='width: 15%'>{{$material->id}}</td>
    <td style='width: 65%'>{{$material->descricao}}</td>
    <td style='width: 10%'>{!!Form::number("qtds[$material->id]", $material->pivot->quant, array('class'=>'form-control', 'id' => 'qtds[$material->id]', 'required' => 'required'))!!}</td>
    <td style='width: 10%'>{!!Form::number("valores_materiais[$material->id]", $material->pivot->vl_total, array('class'=>'form-control', 'id' => 'valores_materiais[$material->id]', 'required' => 'required'))!!}</td>
</tr>
@endforeach

@stop