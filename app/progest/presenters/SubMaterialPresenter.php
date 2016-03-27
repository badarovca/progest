<?php

namespace App\progest\presenters;

class SubMaterialPresenter extends BasePresenter {

    public function getValorUn() {
        $valorUn = round($this->vl_total / $this->qtd_solicitada, 2);
        $valorUn = number_format($valorUn, 2, ',', '.');
        return $valorUn;
    }

    public function getQtdEntregue() {
        $qtd = 0;
        foreach ($this->empenho->entradas as $entrada) {
            foreach ($entrada->subMateriais as $subMaterial) {
                $qtd += $subMaterial->pivot->quant;
            }
        }
        return $qtd;
    }

    public function getQtdRestante() {
        return $this->qtd_solicitada - $this->getQtdEntregue();
    }

}
