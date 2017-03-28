<?php

namespace App\progest\presenters;

class SaidaPresenter extends BasePresenter {

    public function getValorTotalBruto() {
        $total = 0;
        foreach ($this->subMateriais as $subMaterial) {
            $valorUn = round($subMaterial->vl_total / $subMaterial->qtd_solicitada, 2);
            $total += $valorUn * $subMaterial->pivot->quant;
        }
        return $total;
    }

    public function getValorTotal() {
        $total = 0;
        foreach ($this->subMateriais as $subMaterial) {
            $valorUn = round($subMaterial->vl_total / $subMaterial->qtd_solicitada, 2);
            $total += $valorUn * $subMaterial->pivot->quant;
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

    public static function CalcTotal($saidas) {
        $total = 0;
        foreach ($saidas as $saida) {
            foreach ($saida->subMateriais as $subMaterial) {
                $valorUn = round($subMaterial->vl_total / $subMaterial->qtd_solicitada, 2);
                $total += $valorUn * $subMaterial->pivot->quant;
            }
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

    public static function groupBy($criterio, $saidas) {
        switch ($criterio) {
            case "coordenacao":
                return SaidaPresenter::groupByCoordenacao($saidas);
                break;
            case "setor":
                return SaidaPresenter::groupBySetor($saidas);
                break;
            case "solicitante":
                return SaidaPresenter::groupBySolicitante($saidas);
                break;
        }

        return null;
    }

    public static function groupBySolicitante($saidas) {
        $solicitantes = [];
        foreach ($saidas as $saida) {
            $solicitantes[$saida->solicitante->id]['solicitante'] = $saida->solicitante->name;
            $solicitantes[$saida->solicitante->id]['subMateriais'][] = $saida->subMateriais;
            $totalSubMateriais = 0;
            foreach ($saida->subMateriais as $subMaterial) {
                $totalSubMateriais += $subMaterial->pivot->quant * $subMaterial->present()->getValorUnBruto();
            }
            $solicitantes[$saida->solicitante->id]['total'] = isset($solicitantes[$saida->solicitante->id]['total']) ?
                    $solicitantes[$saida->solicitante->id]['total'] + $totalSubMateriais:
                    $totalSubMateriais;
        }
        asort($solicitantes);
        foreach ($solicitantes as $key => $val) {
            $solicitantes[$key]['total'] = number_format(round($val['total'], 2), 2, ',', '.');
        }
        return $solicitantes;
    }

    public static function groupBySetor($saidas) {
        $setores = [];
        foreach ($saidas as $saida) {
            $setores[$saida->solicitante->setor->id]['setor'] = $saida->solicitante->setor->name;
            $setores[$saida->solicitante->setor->id]['subMateriais'][]= $saida->subMateriais;
            $totalSubMateriais = 0;
            foreach ($saida->subMateriais as $subMaterial) {
                $totalSubMateriais += $subMaterial->pivot->quant * $subMaterial->present()->getValorUnBruto();
            }
            $setores[$saida->solicitante->setor->id]['total'] = isset($setores[$saida->solicitante->setor->id]['total']) ?
                    $setores[$saida->solicitante->setor->id]['total'] + $totalSubMateriais :
                    $totalSubMateriais;
        }
        asort($setores);
        foreach ($setores as $key => $val) {
            $setores[$key]['total'] = number_format(round($val['total'], 2), 2, ',', '.');    
        }
        return $setores;
    }

    public static function groupByCoordenacao($saidas) {
        $coordenacoes = [];
        foreach ($saidas as $saida) {
            $coordenacoes[$saida->solicitante->setor->coordenacao->id]['coordenacao'] = $saida->solicitante->setor->coordenacao->name;
            $coordenacoes[$saida->solicitante->setor->coordenacao->id]['subMateriais'][]= $saida->subMateriais;
            $totalSubMateriais = 0;
            foreach ($saida->subMateriais as $subMaterial) {
                $totalSubMateriais += $subMaterial->pivot->quant * $subMaterial->present()->getValorUnBruto();
            }
            $coordenacoes[$saida->solicitante->setor->coordenacao->id]['total'] = isset($coordenacoes[$saida->solicitante->setor->coordenacao->id]['total']) ?
                    $coordenacoes[$saida->solicitante->setor->coordenacao->id]['total'] + $totalSubMateriais :
                    $totalSubMateriais;
        }
        asort($coordenacoes);
        foreach ($coordenacoes as $key => $val) {
            $coordenacoes[$key]['total'] = number_format(round($val['total'], 2), 2, ',', '.');
        }
        return $coordenacoes;
    }

}
