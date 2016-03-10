<?php

namespace App\progest\repositories;

use Auth;
use App\Saida;
use App\Material;
use App\User;
use App\Pedido;

class SaidaRepository {

    public function index() {
        return Saida::all()->sortBy('creatated_at');
    }

    public function store($input) {
        $saida = new Saida(['obs'=>$input['saida']['obs']]);
        $usuario = User::find($input['saida']['solicitante_id']);
        $saida->solicitante()->associate($usuario);
        $saida->responsavel()->associate(Auth::user());
        if(isset($input['pedido_id'])){
            $pedido = Pedido::find($input['pedido_id']);
            $saida->pedido()->associate($pedido);
        }
        $saida->save();

        $materiais = [];

        foreach ($input['materiais']['qtds'] as $key => $val) {
            $materiais[$key] = ['quant'=>$val];
        }
        
        $saida->materiais()->sync($materiais);
        
        foreach($materiais as $key=>$val){
            $material = Material::find($key);
            $material->qtd_1 -= $val['quant'];
            $material->save();
        }
        
        return $saida;
    }

    public function update($id, $input) {
        
    }

    public function show($id) {
        return Saida::findOrFail($id);
    }

    public function destroy($id) {
        $saida = Saida::find($id);
        
        foreach($saida->materiais as $material){
            $material->qtd_1 += $material->pivot->quant;
            $material->save();
        }
        return $saida->delete();
    }

}
