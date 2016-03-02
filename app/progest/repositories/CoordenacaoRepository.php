<?php

namespace App\progest\repositories;

use App\Coordenacao;

class CoordenacaoRepository {

    public function dataForSelect() {
        $baseArray = Coordenacao::all();
        $coordenacoes = array();
        $coordenacoes[] = 'Selecione...';
        foreach ($baseArray as $value) {
            $coordenacoes[$value->id] = $value->name;
        }
        return $coordenacoes;
    }

    public function index() {
        return Coordenacao::all();
    }

    public function store($input) {
        $coordenacao = new Coordenacao();
        $coordenacao->name = $input['name'];
        $coordenacao->coordenador = $input['coordenador'];
        $coordenacao->telefone = $input['telefone'];
        $coordenacao->email = $input['email'];
        $coordenacao->save();
    }

    public function update($id, $input) {
        $coordenacao = Coordenacao::find($id);
        $coordenacao->name = $input['name'];
        $coordenacao->coordenador = $input['coordenador'];
        $coordenacao->telefone = $input['telefone'];
        $coordenacao->email = $input['email'];
        return $coordenacao->save();
    }

    public function show($id) {
        return Coordenacao::findOrFail($id);
    }

    public function destroy($id) {
        $coordenacao = Coordenacao::find($id);
        $coordenacao->desativado = 1;
        return $coordenacao->save();
        //return $coordenacao->delete();
    }

}
