<?php

namespace App\progest\presenters;

class MaterialPresenter extends BasePresenter {

    public function getValorUn() {
        $valorUn = round($this->pivot->vl_total / $this->pivot->quant, 2);
        $valorUn = number_format($valorUn, 2, ',', '.');
        return $valorUn;
    }
    
    public function getQtdEstoque(){
        $qtd = 0;
        foreach ($this->subMateriais as $subMaterial){
            $qtd = $subMaterial->qtd_estoque;
        }
        return $qtd;
    }

}
