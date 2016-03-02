<?php

namespace App\progest\repositories;

use App\Coordenacao;
use App\Setor;

class SetorRepository {

    public function dataForSelect() {
        $baseArray = Setor::all();
        $setores = array();
        $setores[] = 'Selecione...';
        foreach ($baseArray as $value) {
            $setores[$value->id] = $value->name;
        }
        return $setores;
    }

    public function index() {
        return Setor::all();
    }

    public function store($input) {
        $setor = new Setor();
        $setor->name = $input['name'];
        
        $coordenacao = Coordenacao::find($input['coordenacao_id']);
        $setor->coordenacao()->associate($coordenacao);
        
        $setor->save();
    }

    public function update($id, $input) {
        $setor = Setor::find($id);
        $setor->name = $input['name'];
        
        $coordenacao = Setor::find($input['coordenacao_id']);
        $setor->coordenacao()->associate($coordenacao);
        
        return $setor->save();
    }

    public function show($id) {
        return Setor::findOrFail($id);
    }

    public function destroy($id) {
        $setor = Setor::find($id);
        $setor->desativado = 1;
        return $setor->save();
        //return $setor->delete();
    }

}
