<?php

namespace App\progest\presenters;

class SaldoPresenter extends BasePresenter {

    public function getValorSaldoFinal($linha) {
        if ($linha->vl_entrada != null || $linha->vl_saida != null || $linha->vl_saldo_final != null) {
            return $linha->vl_saldo_final;
        } elseif ($linha->vl_saldo_final == null) {
            return $linha->vl_saldo_inicial;
        }
    }

}
