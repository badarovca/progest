<?php

namespace App\progest\presenters;

class SubMaterialPresenter extends BasePresenter {

    public function getValorUn() {
        $valorUn = round($this->vl_total / $this->qtd_solicitada, 2);
        $valorUn = number_format($valorUn, 2, ',', '.');
        return $valorUn;
    }

}
