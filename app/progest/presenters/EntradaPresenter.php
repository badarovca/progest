<?php

namespace App\progest\presenters;

class EntradaPresenter extends BasePresenter {

    public function getValorTotalBruto() {
        $total = 0;
        foreach ($this->subMateriais as $subMaterial) {
            $valorUn = $subMaterial->vl_total / $subMaterial->qtd_solicitada;
            $total += $valorUn * $subMaterial->pivot->quant;
        }
        return round($total, 2);
    }

    public function getValorTotal() {
        $total = 0;
        foreach ($this->subMateriais as $subMaterial) {
            $valorUn = $subMaterial->vl_total / $subMaterial->qtd_solicitada;
            $total += $valorUn * $subMaterial->pivot->quant;
        }
        $total = number_format(round($total, 2), 2, ',', '.');
        return $total;
    }

    public static function CalcTotal($entradas) {
        $total = 0;
        foreach ($entradas as $entrada) {
            foreach ($entrada->subMateriais as $subMaterial) {
                $valorUn = $subMaterial->vl_total / $subMaterial->qtd_solicitada;
                $total += $valorUn * $subMaterial->pivot->quant;
            }
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

    public static function groupBy($criterio, $entradas) {
        switch ($criterio) {
            case "coordenacao":
                return EntradaPresenter::groupByCoordenacao($entradas);
                break;
            case "setor":
                return EntradaPresenter::groupBySetor($entradas);
                break;
            case "solicitante":
                return EntradaPresenter::groupBySolicitante($entradas);
                break;
        }

        return null;
    }

    public static function groupBySolicitante($entradas) {
        $solicitantes = [];
        foreach ($entradas as $entrada) {
            $solicitantes[$entrada->empenho->solicitante->id]['solicitante'] = $entrada->empenho->solicitante->name;
            $solicitantes[$entrada->empenho->solicitante->id]['subMateriais'][] = $entrada->subMateriais;
            $solicitantes[$entrada->empenho->solicitante->id]['total'] = isset($solicitantes[$entrada->empenho->solicitante->id]['total']) ?
                    $solicitantes[$entrada->empenho->solicitante->id]['total'] + $entrada->present()->getValorTotalBruto() :
                    $entrada->present()->getValorTotalBruto();
        }
        foreach ($solicitantes as $key => $val) {
            $solicitantes[$key]['total'] = number_format($val['total'], 2, ',', '.');
        }
        return $solicitantes;
    }

    public static function groupBySetor($entradas) {
        $setores = [];
        foreach ($entradas as $entrada) {
            $setores[$entrada->empenho->solicitante->setor->id]['setor'] = $entrada->empenho->solicitante->setor->name;
            $setores[$entrada->empenho->solicitante->setor->id]['subMateriais'][] = $entrada->subMateriais;
            $setores[$entrada->empenho->solicitante->setor->id]['total'] = isset($setores[$entrada->empenho->solicitante->setor->id]['total']) ?
                    $setores[$entrada->empenho->solicitante->setor->id]['total'] + $entrada->present()->getValorTotalBruto() :
                    $entrada->present()->getValorTotalBruto();
        }
        foreach ($setores as $key => $val) {
            $setores[$key]['total'] = number_format($val['total'], 2, ',', '.');
        }
        return $setores;
    }

    public static function groupByCoordenacao($entradas) {
        $coordenacoes = [];
        foreach ($entradas as $entrada) {
            $coordenacoes[$entrada->empenho->solicitante->setor->coordenacao->id]['coordenacao'] = $entrada->empenho->solicitante->setor->coordenacao->name;
            $coordenacoes[$entrada->empenho->solicitante->setor->coordenacao->id]['subMateriais'][] = $entrada->subMateriais;
            $coordenacoes[$entrada->empenho->solicitante->setor->coordenacao->id]['total'] = isset($coordenacoes[$entrada->empenho->solicitante->setor->coordenacao->id]['total']) ?
                    $coordenacoes[$entrada->empenho->solicitante->setor->coordenacao->id]['total'] + $entrada->present()->getValorTotalBruto() :
                    $entrada->present()->getValorTotalBruto();
        }
        foreach ($coordenacoes as $key => $val) {
            $coordenacoes[$key]['total'] = number_format($val['total'], 2, ',', '.');
        }
        return $coordenacoes;
    }

}
