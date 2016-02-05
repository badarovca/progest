<?php

namespace App\progest\repositories;

use App\Fornecedor;
use App\Empenho;

class EmpenhoRepository {

    
    public function index() {
        return Empenho::all();
    }

    public function store($input) {
        $empenho = new Empenho();
        $empenho->numero = $input['numero'];
        $empenho->tipo = $input['tipo'];
        $empenho->cat_despesa = $input['cat_despesa'];
        $empenho->mod_aplicacao = $input['mod_aplicacao'];
        $empenho->el_consumo = $input['el_consumo'];
        $empenho->mod_licitacao = $input['mod_licitacao'];
        $empenho->num_processo = $input['num_processo'];
        $empenho->solicitantes = $input['solicitantes'];

        $fornecedor = Fornecedor::find($input['fornecedor_id']);
        $empenho->fornecedor()->associate($fornecedor);

        $empenho->save();
    }

    public function update($id, $input) {
        $empenho = Empenho::find($id);
        $empenho->numero = $input['numero'];
        $empenho->tipo = $input['tipo'];
        $empenho->cat_despesa = $input['cat_despesa'];
        $empenho->mod_aplicacao = $input['mod_aplicacao'];
        $empenho->el_consumo = $input['el_consumo'];
        $empenho->mod_licitacao = $input['mod_licitacao'];
        $empenho->num_processo = $input['num_processo'];
        $empenho->solicitantes = $input['solicitantes'];

        $fornecedor = Fornecedor::find($input['fornecedor_id']);
        $empenho->fornecedor()->associate($fornecedor);

        return $empenho->save();
    }

    public function show($id) {
        return Empenho::findOrFail($id);
    }

    public function destroy($id) {
        $empenho = Empenho::find($id);
        return $empenho->delete();
    }

}
