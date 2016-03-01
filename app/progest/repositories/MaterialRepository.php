<?php

namespace App\progest\repositories;

use App\Material;
use App\SubItem;
use App\Unidade;

class MaterialRepository {

    public function dataForSelect($filter = null) {
        if ($filter) {
            $baseArray = Material::where(function($query) use (&$filter) {
                        if ($filter['disponivel']) {
                            $query->where('qtd_1', '>', 0);
                            $query->where('disponivel', '=', 1);
                        }
                    })->get();
        } else {
            $baseArray = Material::all();
        }
        $materiais = array('' => 'Selecione...');
        foreach ($baseArray as $value) {
            $materiais[$value->id] = $value->descricao . " (cod: $value->codigo)";
        }
        return $materiais;
    }

    public function index() {
        return Material::all();
    }

    public function store($input) {
        $material = new Material();
        $material->codigo = $input['codigo'];
        $material->descricao = $input['descricao'];
        $material->marca = $input['marca'];
        $material->qtd_1 = $input['qtd_1'];
        $material->qtd_2 = $input['qtd_2'];
        $material->qtd_3 = $input['qtd_3'];
        $material->qtd_4 = $input['qtd_4'];
        $material->disponivel = isset($input['disponivel']) ? 1 : 0;

        $subItem = SubItem::find($input['sub_item_id']);
        $material->subItem()->associate($subItem);

        $unidade = Unidade::find($input['unidade_id']);
        $material->unidade()->associate($unidade);

        $material->save();
    }

    public function update($id, $input) {
        $material = Material::find($id);
        $material->codigo = $input['codigo'];
        $material->descricao = $input['descricao'];
        $material->marca = $input['marca'];
        $material->qtd_1 = $input['qtd_1'];
        $material->qtd_2 = $input['qtd_2'];
        $material->qtd_3 = $input['qtd_3'];
        $material->qtd_4 = $input['qtd_4'];
        $material->disponivel = isset($input['disponivel']) ? 1 : 0;

        $subItem = SubItem::find($input['sub_item_id']);
        $material->subItem()->associate($subItem);

        $unidade = Unidade::find($input['unidade_id']);
        $material->unidade()->associate($unidade);

        return $material->save();
    }

    public function show($id) {
        return Material::findOrFail($id);
    }

    public function destroy($id) {
        $material = Material::find($id);
        return $material->delete();
    }

    public function search($param) {
        $materiais = Material::where('descricao', 'like', "%$param%")->orWhere('marca', 'like', "%$param%")->get();
        return $materiais;
    }

}
