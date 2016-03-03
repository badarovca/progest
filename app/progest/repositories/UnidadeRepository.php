<?php

namespace App\progest\repositories;

use App\Unidade;

class UnidadeRepository {

    public function dataForSelect() {
        $baseArray = Unidade::all();
        $unidades = array();
        $unidades[] = 'Selecione...';
        foreach ($baseArray as $value) {
            $unidades[$value->id] = $value->name;
        }
        return $unidades;
    }

    public function index() {
        return Unidade::all();
    }

    public function store($input) {
        $unidade = new Unidade();
        $unidade->name = $input['name'];
        $unidade->status = 1;
        $unidade->save();
    }

    public function update($id, $input) {
        $unidade = Unidade::find($id);
        $unidade->name = $input['name'];
        return $unidade->save();
    }

    public function show($id) {
        return Unidade::findOrFail($id);
    }

    public function destroy($id) {
        $unidade = Unidade::find($id);
        return $unidade->delete();
    }
    
    public function desativar($id){
        $unidade = Unidade::find($id);
        $unidade->status = 0;
        return $unidade->save();
    }

}
