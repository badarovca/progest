<?php

namespace App\progest\presenters;

class SubMaterialPresenter extends BasePresenter {
    
    public function getValorUnBruto(){
        return ($this->vl_total / $this->qtd_solicitada);
    }
    
    public function getValorUn() {
        $valorUn = round($this->vl_total / $this->qtd_solicitada, 2);
        $valorUn = number_format($valorUn, 2, ',', '.');
        return $valorUn;
    }
    
    public function getValorTotalEntregue() {
        $valorUn = round($this->vl_total / $this->qtd_solicitada, 2);
        $valorTotal = $this->getQtdEntregue() * $valorUn;
        $valorTotal = number_format($valorTotal, 2, ',', '.');
        return $valorTotal;
    }

    public function getQtdEntregue() {
        $qtd = 0;
        foreach ($this->empenho->entradas as $entrada) {
            foreach ($entrada->subMateriais as $subMaterial) {
                if ($this->id == $subMaterial->id) {
                    $qtd += $subMaterial->pivot->quant;
                }
            }
        }
        return $qtd;
    }

    public function getVencimento() {
        if ($this->vencimento != "0000-00-00") {
            return date('d/m/Y', strtotime($this->vencimento));
        } else {
            return "-";
        }
    }

    public function getQtdRestante() {
        return $this->qtd_solicitada - $this->getQtdEntregue();
    }

    public function getQtdDevolvida() {
        $qtd = 0;
        foreach ($this->devolucoes as $devolucao) {
            if ($this->pivot->saida_id == $devolucao->saida->id) {
                $qtd += $devolucao->pivot->quant;
            }
        }
        return $qtd;
    }

    public function getQtdMaxDevolucao() {
        return $this->pivot->quant - $this->getQtdDevolvida();
    }

}
