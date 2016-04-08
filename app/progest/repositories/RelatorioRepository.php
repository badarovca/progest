<?php

namespace App\progest\repositories;

use App\Saldo;

class RelatorioRepository {

    public function updateSaldo($subMaterial, $valor) {
        $mes = date("m");
        $ano = date("Y");
        $saldo = Saldo::where(function($query) use(&$mes, &$ano, &$subMaterial) {
                    $query->where('mes', '=', $mes);
                    $query->where('ano', '=', $ano);
                    $query->where('sub_item_id', '=', $subMaterial->material->subItem->id);
                })->first();
        if($saldo != null){
            $saldo->valor += $valor;
            $saldo->save();
        }else{
            $date = strtotime($ano."-".$mes."-01 -1 month");
            $valor += $this->getSaldoMes($date, $subMaterial->material->subItem->id);
            $saldo = new Saldo(['mes'=>$mes, 'ano'=>$ano, 'sub_item_id'=>$subMaterial->material->subItem->id, 'valor'=>$valor]);
            $saldo->save();
        }
        return $saldo;
    }

    public function getSaldoMes($date, $subItemId) {
        $saldo = Saldo::where(function ($query) use (&$date, &$subItemId) {
                    $query->where('mes', '=', date('m', $date));
                    $query->where('ano', '=', date('Y', $date));
                    $query->where('sub_item_id', '=', $subItemId);
                })->get();
        return $saldo->first() == null ? 0 : $saldo->first()->valor;
    }

    public function getRelatorioContabil($input) {
        $periodo = [date("Y-m-d", strtotime($input['ano'] . "-" . $input['mes'] . "-01")), date("Y-m-t", strtotime($input['ano'] . "-" . $input['mes'] . "-01"))];
//        dd($periodo);
        $mesAnterior = date("m", strtotime($periodo[0]."-1 month"));
        $anoAnterior = date("Y", strtotime($periodo[0]."-1 month"));
        $result = \DB::select(\DB::raw("
            select entradas.*, saidas.vl_saida, devolucoes.vl_devolucao, 
            saldos_finais.vl_saldo_final, saldos_iniciais.vl_saldo_inicial from
            (select sub_items.id, sub_items.material_consumo,
            SUM(ROUND(sub_materials.vl_total/sub_materials.qtd_solicitada, 2)*entrada_sub_material.quant)
            as vl_entrada
            from sub_items
            left join materials
            on sub_items.id = materials.sub_item_id
            left join sub_materials
            on materials.id = sub_materials.material_id
            left join entrada_sub_material
            on sub_materials.id = entrada_sub_material.sub_material_id and (entrada_sub_material.created_at between '".$periodo[0]."' and '".$periodo[1]."')
            left join entradas
            on entrada_sub_material.entrada_id = entradas.id 
            group by sub_items.id) entradas
            left join 
            (select sub_items.id, sub_items.material_consumo,
            SUM(ROUND(sub_materials.vl_total/sub_materials.qtd_solicitada, 2)*saida_sub_material.quant)
            as vl_saida
            from sub_items
            left join materials
            on sub_items.id = materials.sub_item_id
            left join sub_materials
            on materials.id = sub_materials.material_id
            left join saida_sub_material
            on sub_materials.id = saida_sub_material.sub_material_id and (saida_sub_material.created_at between '".$periodo[0]."' and '".$periodo[1]."')
            left join saidas
            on saida_sub_material.saida_id = saidas.id 
            group by sub_items.id) saidas
            on entradas.id = saidas.id
            left join
            (select sub_items.id, sub_items.material_consumo,
            SUM(ROUND(sub_materials.vl_total/sub_materials.qtd_solicitada, 2)*devolucao_sub_material.quant)
            as vl_devolucao
            from sub_items
            left join materials
            on sub_items.id = materials.sub_item_id
            left join sub_materials
            on materials.id = sub_materials.material_id
            left join devolucao_sub_material
            on sub_materials.id = devolucao_sub_material.sub_material_id and (devolucao_sub_material.created_at between '".$periodo[0]."' and '".$periodo[1]."')
            left join devolucaos
            on devolucao_sub_material.devolucao_id = devolucaos.id 
            group by sub_items.id) devolucoes
            on saidas.id = devolucoes.id
            left join
            (select sub_items.id, sub_items.material_consumo, 
            saldos.valor as vl_saldo_inicial
            from sub_items
            left join saldos
            on sub_items.id = saldos.sub_item_id and saldos.mes = '".$mesAnterior."' and saldos.ano = '".$anoAnterior."'
            group by sub_items.id) saldos_iniciais
            on devolucoes.id = saldos_iniciais.id
            left join
            (select sub_items.id, sub_items.material_consumo, 
            saldos.valor as vl_saldo_final
            from sub_items
            left join saldos
            on sub_items.id = saldos.sub_item_id and saldos.mes = '".$input['mes']."' and saldos.ano = '".$input['ano']."'
            group by sub_items.id) saldos_finais
            on saldos_iniciais.id = saldos_finais.id;"));
        return collect($result);
    }

}
