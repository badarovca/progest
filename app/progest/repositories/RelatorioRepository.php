<?php

namespace App\progest\repositories;

use App\Saldo;
use App\SubItem;
use DB;

class RelatorioRepository {

    public function updateSaldo($subMaterial, $valor) {
        $mes = date("m");
        $ano = date("Y");
        $saldo = null;

        while ($saldo == null) {
            $saldo = Saldo::where(function($query) use(&$mes, &$ano, &$subMaterial) {
                        $query->where('mes', '=', $mes);
                        $query->where('ano', '=', $ano);
                        $query->where('sub_item_id', '=', $subMaterial->subItem->id);
                    })->first();
            if ($saldo == null) {
                $periodo = date("Y-m-d", strtotime($ano . "-" . $mes . "-01"));
                $this->inicializaMes($periodo);
            }
        }

        $saldo->valor += $valor;
        $saldo->save();
        return $saldo;
    }

    public function getSaldosMes($date) {
        $saldos = Saldo::where(function ($query) use (&$date, &$subItemId) {
                    $query->where('mes', '=', date('m', $date));
                    $query->where('ano', '=', date('Y', $date));
                })->get();
        return $saldos;
    }

    public function getSaldoMesBySubItem($date, $subItemId = null) {
        $saldo = Saldo::where(function ($query) use (&$date, &$subItemId) {
                    $query->where('mes', '=', date('m', $date));
                    $query->where('ano', '=', date('Y', $date));
                    if ($subItemId != null) {
                        $query->where('sub_item_id', '=', $subItemId);
                    }
                })->get();
        return $saldo->first() == null ? 0 : $saldo->first()->valor;
    }

    public function getRelatorioContabil($input) {
        $periodo = [date("Y-m-d", strtotime($input['ano'] . "-" . $input['mes'] . "-01")), date("Y-m-t", strtotime($input['ano'] . "-" . $input['mes'] . "-01"))];
        if ($this->getCountSaldoPeriodo($periodo[0]) == 0) {
            $this->inicializaMes($periodo[0]);
        }
        $result = RelatorioRepository::consultaRelatorioSQL($periodo, $input);

        return $result;
    }

    public function inicializaMes($periodo) {
        $periodoTemp = date("Y-m-d", strtotime($periodo . "-1 month"));

        $contSaldo = $this->getCountSaldoPeriodo($periodo);
        $contMeses = 0;
        $log = "";
        //conta qtd de meses ainda não iniciados
        while ($contSaldo == 0 && date("Y", strtotime($periodoTemp)) > 2016) {
            $contSaldo = $this->getCountSaldoPeriodo($periodoTemp);

            $periodoTemp = date("Y-m-d", strtotime($periodoTemp . "-1 month"));
            $contMeses++;
        }
        $periodoTemp = date("Y-m-d", strtotime($periodoTemp . "+1 month"));
//        dd($periodoTemp);
        //inicializa meses
        while ($contMeses > 0) {
            $date = strtotime($periodoTemp);
            $saldos = $this->getSaldosMes($date);
            $periodoTemp = date("Y-m-d", strtotime($periodoTemp . "+1 month"));
            $mes = date("m", strtotime($periodoTemp));
            $ano = date("Y", strtotime($periodoTemp));
            if ($saldos->isEmpty()) {
                for($i = 1; $i<54; $i++){
                    $newSaldo = new Saldo(['mes' => $mes, 'ano' => $ano, 'sub_item_id' => $i, 'valor' => 0]);
                    $newSaldo->save();
                }
            } else {
                foreach ($saldos as $saldo) {
                    $newSaldo = new Saldo(['mes' => $mes, 'ano' => $ano, 'sub_item_id' => $saldo->sub_item_id, 'valor' => $saldo->valor]);
                    $newSaldo->save();
                }
            }

            $contMeses--;
        }
    }

    public function getCountSaldoPeriodo($periodo) {
        $mesAnterior = date("m", strtotime($periodo));
        $anoAnterior = date("Y", strtotime($periodo));
        return \DB::table('saldos')->where('mes', $mesAnterior)->where('ano', $anoAnterior)->count();
    }

    private static function consultaRelatorioSQL($periodo, $input) {
        $mesAnterior = date("m", strtotime($periodo[0] . "-1 month"));
        $anoAnterior = date("Y", strtotime($periodo[0] . "-1 month"));
        $result = \DB::select(\DB::raw("
            select id, material_consumo, sum(vl_entrada) as vl_entrada, sum(vl_saida) as vl_saida, sum(vl_devolucao) as vl_devolucao, 
            sum(vl_saldo_inicial) as vl_saldo_inicial, sum(vl_saldo_final) as vl_saldo_final
            from(
            (select sub_items.id, sub_items.material_consumo, 
            SUM(ROUND(sub_materials.vl_total/sub_materials.qtd_solicitada, 2)*entrada_sub_material.quant)
            as vl_entrada, null as vl_saida, null as vl_devolucao, null as vl_saldo_inicial, null as vl_saldo_final
            from sub_items
            left join sub_materials
            on sub_items.id = sub_materials.sub_item_id
            left join materials
            on materials.id = sub_materials.material_id
            right join entrada_sub_material
            on sub_materials.id = entrada_sub_material.sub_material_id
            right join entradas
            on entrada_sub_material.entrada_id = entradas.id 
            where (entrada_sub_material.created_at between '" . $periodo[0] . "' and '" . $periodo[1] . "')
            group by sub_items.id)
            union all
            (select sub_items.id, sub_items.material_consumo, 
            null as vl_entrada, SUM(ROUND(sub_materials.vl_total/sub_materials.qtd_solicitada, 2)*saida_sub_material.quant)
            as vl_saida, null as vl_devolucao, null as vl_saldo_inicial, null as vl_saldo_final
            from sub_items
            left join sub_materials
            on sub_items.id = sub_materials.sub_item_id
            left join materials
            on materials.id = sub_materials.material_id
            right join saida_sub_material
            on sub_materials.id = saida_sub_material.sub_material_id
            right join saidas
            on saida_sub_material.saida_id = saidas.id 
            where (saida_sub_material.created_at between '" . $periodo[0] . "' and '" . $periodo[1] . "')
            group by sub_items.id)
            union all
            (select sub_items.id, sub_items.material_consumo, 
            null as vl_entrada, null as vl_saida, SUM(ROUND(sub_materials.vl_total/sub_materials.qtd_solicitada, 2)*devolucao_sub_material.quant) as vl_devolucao, 
            null as vl_saldo_inicial, null as vl_saldo_final
            from sub_items
            left join sub_materials
            on sub_items.id = sub_materials.sub_item_id
            left join materials
            on materials.id = sub_materials.material_id
            right join devolucao_sub_material
            on sub_materials.id = devolucao_sub_material.sub_material_id
            right join devolucaos
            on devolucao_sub_material.devolucao_id = devolucaos.id
            where (devolucao_sub_material.created_at between '" . $periodo[0] . "' and '" . $periodo[1] . "')
            group by sub_items.id) 
            union all
            (select sub_items.id, sub_items.material_consumo,
            null as vl_entrada, null as vl_saida, null as vl_devolucao, saldos.valor as vl_saldo_inicial, null as vl_saldo_final 
            from sub_items
            right join saldos
            on sub_items.id = saldos.sub_item_id
            where saldos.mes = '" . $mesAnterior . "' and saldos.ano = '" . $anoAnterior . "' and saldos.valor != 0
            group by sub_items.id)
            union all
            (select sub_items.id, sub_items.material_consumo, 
            null as vl_entrada, null as vl_saida, null as vl_devolucao, null as vl_saldo_inicial, saldos.valor as vl_saldo_final
            from sub_items
            right join saldos
            on sub_items.id = saldos.sub_item_id
            where saldos.mes = '" . $input['mes'] . "' and saldos.ano = '" . $input['ano'] . "' and saldos.valor != 0
            group by sub_items.id)) rel
            group by id;"));
        return collect($result);
    }

    public function getTotais($dados) {
        if ($dados == null) {
            return null;
        }
        $totais = ['entradas' => 0, 'devolucoes' => 0, 'saidas' => 0, 'saldo_inicial' => 0, 'saldo_final' => 0];
        foreach ($dados as $linha) {
            $totais['entradas'] += $linha->vl_entrada;
            $totais['devolucoes'] += $linha->vl_devolucao;
            $totais['saidas'] += $linha->vl_saida;
            $totais['saldo_inicial'] += $linha->vl_saldo_inicial;
            $totais['saldo_final'] += $linha->vl_saldo_final;
        }

        return $totais;
    }

}
