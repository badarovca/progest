<?php

namespace App\progest\presenters;

class EmpenhoPresenter extends BasePresenter {

    public function getValorTotal() {
        $valor = 0;
        foreach ($this->subMateriais as $subMaterial) {
            $valor += $subMaterial->vl_total;
        }
        $valor = number_format($valor, 2, ',', '.');
        return $valor;
    }

    public function getValorEntregue() {
        $valor = 0;
        foreach ($this->subMateriais as $subMaterial) {
            foreach ($subMaterial->entradas as $entrada) {
                $valor += ($subMaterial->vl_total / $subMaterial->qtd_solicitada) * $entrada->pivot->quant;
            }
        }
        $valor = number_format($valor, 2, ',', '.');
        return $valor;
    }

    public function getValorRestante() {
        $valor = 0;
        $valorEntregue = 0;
        $valorTotal = 0;
        foreach ($this->subMateriais as $subMaterial) {
            foreach ($subMaterial->entradas as $entrada) {
                $valorEntregue += ($subMaterial->vl_total / $subMaterial->qtd_solicitada) * $entrada->pivot->quant;
            }
        }
        foreach ($this->subMateriais as $subMaterial) {
            $valorTotal += $subMaterial->vl_total;
        }
        $valor = number_format($valorTotal - $valorEntregue, 2, ',', '.');
        return $valor;
    }

    public static function calcTotal($empenhos) {
        $total = 0;
        foreach ($empenhos as $empenho) {
            foreach ($empenho->subMateriais as $subMaterial) {
                $total += $subMaterial->vl_total;
            }
        }
        $total = number_format($total, 2, ',', '.');
        $totais['total'] = $total;
        $totais['totalEntregue'] = EmpenhoPresenter::calcTotalEntregue($empenhos);
        $totais['totalPendente'] = EmpenhoPresenter::calcTotalPendente($empenhos);
        return $totais;
    }

    public static function calcTotalEntregue($empenhos) {
        $total = 0;
        foreach ($empenhos as $empenho) {
            $valor = 0;
            foreach ($empenho->subMateriais as $subMaterial) {
                foreach ($subMaterial->entradas as $entrada) {
                    $valor += ($subMaterial->vl_total / $subMaterial->qtd_solicitada) * $entrada->pivot->quant;
                }
            }
            $total += $valor;
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

    public static function calcTotalPendente($empenhos) {
        $total = 0;
        foreach ($empenhos as $empenho) {
            $valor = 0;
            $valorEntregue = 0;
            $valorTotal = 0;
            foreach ($empenho->subMateriais as $subMaterial) {
                foreach ($subMaterial->entradas as $entrada) {
                    $valorEntregue += ($subMaterial->vl_total / $subMaterial->qtd_solicitada) * $entrada->pivot->quant;
                }
            }
            foreach ($empenho->subMateriais as $subMaterial) {
                $valorTotal += $subMaterial->vl_total;
            }
            $total += $valorTotal - $valorEntregue;
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

}
