<?php

namespace App\progest\presenters;

class EntradaPresenter extends BasePresenter {

    public function getValorTotal() {
        $total = 0;
        foreach ($this->subMateriais as $subMaterial){
            $valorUn = round($subMaterial->vl_total / $subMaterial->qtd_solicitada, 2);
            $total += $valorUn;
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

}
