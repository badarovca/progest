@extends('admin.empenhos.form')

@section('lista-materiais')
@foreach($empenho->subMateriais as $subMaterial)
<tr>
    <td style='width: 15%'>{{$subMaterial->material->id}}</td>
    <td style='width: 0%'>{{$subMaterial->material->descricao}}</td>
    <td style='width: 10%'>{!!Form::number("submateriais[".$subMaterial->material->id."][qtd_solicitada]", $subMaterial->qtd_solicitada, array('class'=>'form-control', 'id' => "submateriais[".$subMaterial->material->id."][qtd_solicitada]", 'required' => 'required'))!!}</td>
    <td style='width: 10%'>{!!Form::text("submateriais[".$subMaterial->material->id."][vl_total]", number_format($subMaterial->vl_total, 2, ',', '.'), array('class'=>'form-control valor valor-total-material', 'id' => "submateriais[".$subMaterial->material->id."][vl_total]", 'required' => 'required'))!!}</td>
    <td style='width: 10%'>{!!Form::text("valor[$subMaterial->id]", $subMaterial->present()->getValorUn, array('class'=>'form-control valor', 'id' => 'valor[$subMaterial->id]', 'disabled' =>'true'))!!}</td>
    <td style='width: 10%'>{!!Form::date("submateriais[".$subMaterial->material->id."][vencimento]", $subMaterial->vencimento, array('class'=>'form-control', 'id' => "submateriais[".$subMaterial->material->id."][vl_total]"))!!}</td>
    <td style='width: 10%'>{!!Form::text("submateriais[".$subMaterial->material->id."][subItem]", $subMaterial->subItem->id, array('class'=>'form-control', 'id' => "submateriais[".$subMaterial->material->id."][subItem]", 'required' => 'required', 'readonly' => 'true'))!!}</td>
    <td style='width: 5%'><a href='javascript:void(0)' class='btn btn-danger btn-xs remove-material' ><i class='fa fa-fw fa-remove'></i> remover</a></td>
</tr>
@endforeach

@stop