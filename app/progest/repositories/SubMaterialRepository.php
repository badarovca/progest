<?php

namespace App\progest\repositories;

use App\SubMaterial;

class SubMaterialRepository {

    public function index($material = null) {
        return SubMaterial::where('material_id', $material)->orderBy('vencimento')->paginate(50);
    }

    public function update($id, $input) {
        $submaterial = SubMaterial::find($id);
        $submaterial->vencimento = $input['vencimento'];
//        $submaterial->qtd_estoque = $input['qtd_estoque'];
//        $submaterial->vl_total = $input['vl_total'];
        return $submaterial->save();
    }

    public function show($id) {
        return SubMaterial::findOrFail($id);
    }

    public function destroy($id) {
        $submaterial = SubMaterial::find($id);
        return $submaterial->delete();
    }

}
