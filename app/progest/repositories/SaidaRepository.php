<?php

namespace App\progest\repositories;

use Auth;
use App\Saida;
use App\Material;
use App\SubMaterial;
use App\User;
use App\Pedido;

class SaidaRepository {

    public function index() {
        return Saida::all()->sortBy('creatated_at');
    }

    public function store($input) {
        $subMateriais = $this->saidaSubMateriais($input['materiais']['qtds']);
        $saida = new Saida(['obs' => $input['saida']['obs']]);
        $usuario = User::find($input['saida']['solicitante_id']);
        $saida->solicitante()->associate($usuario);
        $saida->responsavel()->associate(Auth::user());
        if (isset($input['pedido_id'])) {
            $pedido = Pedido::find($input['pedido_id']);
            $saida->pedido()->associate($pedido);
        }
        $saida->save();

        $saida->subMateriais()->sync($subMateriais);

        return $saida;
    }

    public function update($id, $input) {
        
    }

    public function show($id) {
        return Saida::findOrFail($id);
    }

    public function destroy($id) {
        $saida = Saida::find($id);

        foreach ($saida->subMateriais as $subMaterial) {
            $subMaterial->qtd_estoque += $subMaterial->pivot->quant;
            $subMaterial->save();
        }
        return $saida->delete();
    }

    public function saidaSubMateriais($materiaisInput) {
        $subMateriaisArray = [];
        foreach ($materiaisInput as $id => $qtd) {
            $material = Material::find($id);
            $subMateriais = $material->subMateriais->filter(function($item) {
                        return $item->qtd_estoque > 0;
                    })->sortBy('created_at');
            $rest = $qtd;
            foreach ($subMateriais as $subMaterial) {
                if ($subMaterial->qtd_estoque >= $rest) {
                    $subMaterial->qtd_estoque -= $rest;
                    $subMateriaisArray[$subMaterial->id] = ['quant' => $rest];
                    $rest = 0;
                } else {
                    $rest -= $subMaterial->qtd_estoque;
                    $subMateriaisArray[$subMaterial->id] = ['quant' => $subMaterial->qtd_estoque];
                    $subMaterial->qtd_estoque -= $subMaterial->qtd_estoque;
                }
                $subMaterial->save();
                if ($rest == 0)
                    break;
            }
        }
        return $subMateriaisArray;
    }

}
