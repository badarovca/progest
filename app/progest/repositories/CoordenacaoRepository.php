<?php

namespace App\progest\repositories;

use App\Coordenacao;

class CoordenacaoRepository {

    public function dataForSelect() {
        $baseArray = Coordenacao::all();
        $coordenacoes = array();
        $coordenacoes[''] = 'Selecione...';
        foreach ($baseArray as $value) {
            if ($value->status == 1){
                $coordenacoes[$value->id] = $value->name;
            }
        }
        return $coordenacoes;
    }

    public function index() {
        return Coordenacao::paginate(50);
    }

    public function store($input) {
        $coordenacao = new Coordenacao();
        $coordenacao->name = $input['name'];
        $coordenacao->coordenador = $input['coordenador'];
        $coordenacao->telefone = $input['telefone'];
        $coordenacao->email = $input['email'];
        $coordenacao->status = isset($input['status']) ? 1 : 0;
        //$coordenacao->status = 1;
        $coordenacao->save();
    }

    public function update($id, $input) {
        $coordenacao = Coordenacao::find($id);
        $coordenacao->name = $input['name'];
        $coordenacao->coordenador = $input['coordenador'];
        $coordenacao->telefone = $input['telefone'];
        $coordenacao->email = $input['email'];
        $coordenacao->status = isset($input['status']) ? 1 : 0;
        return $coordenacao->save();
    }

    public function show($id) {
        return Coordenacao::findOrFail($id);
    }

    public function destroy($id) {
        $coordenacao = Coordenacao::find($id);
        return $coordenacao->delete();
    }
    
//    public function desativar($id){
//        $coordenacao = Coordenacao::find($id);
//        $coordenacao->status = 0;
//        return $coordenacao->save();
//    }

}
