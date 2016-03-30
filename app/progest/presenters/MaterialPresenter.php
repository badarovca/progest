<?php

namespace App\progest\presenters;

class MaterialPresenter extends BasePresenter {

    public function getQtdEstoque() {
        $qtd = 0;
        foreach ($this->subMateriais as $subMaterial) {
            $qtd += $subMaterial->qtd_estoque;
        }
        return $qtd;
    }

}
