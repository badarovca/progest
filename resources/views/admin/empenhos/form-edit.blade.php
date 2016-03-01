@extends('admin.empenhos.form')

@section('lista-materiais')
@foreach($empenho->materiais as $material)
<tr>
    <td style='width: 15%'>{{$material->id}}</td>
    <td style='width: 60%'>{{$material->descricao}}</td>
    <td style='width: 10%'>{!!Form::number("qtds[$material->id]", $material->pivot->quant, array('class'=>'form-control', 'id' => 'qtds[$material->id]', 'required' => 'required'))!!}</td>
    <td style='width: 15%'>{!!Form::text("valores_materiais[$material->id]", number_format($material->pivot->vl_total, 2, ',', '.'), array('class'=>'form-control valor', 'id' => 'valores_materiais[$material->id]', 'required' => 'required'))!!}</td>
</tr>
@endforeach

@stop