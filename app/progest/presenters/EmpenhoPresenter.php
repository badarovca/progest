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

}
