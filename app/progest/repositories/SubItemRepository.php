<?php

namespace App\progest\repositories;

use App\SubItem;

class SubItemRepository {

    public function dataForSelect() {
        $baseArray = SubItem::all();
        $subitemes = array();
        $subitemes[] = 'Selecione...';
        foreach ($baseArray as $value) {
            if ($value->status == 1) {
                $subitemes[$value->id] = $value->id . "-" . $value->material_consumo;
            }
        }
        return $subitemes;
    }

    public function index() {
        return SubItem::all();
    }

    public function store($input) {
        $subitem = new SubItem();
        $subitem->material_consumo = $input['material_consumo'];
        $subitem->status = isset($input['status']) ? 1 : 0;
        //$setor->status = 1;
        //$subitem->status = 1;
        $subitem->save();
    }

    public function update($id, $input) {
        $subitem = SubItem::find($id);
        $subitem->material_consumo = $input['material_consumo'];
        $subitem->status = isset($input['status']) ? 1 : 0;
        return $subitem->save();
    }

    public function show($id) {
        return SubItem::findOrFail($id);
    }

    public function destroy($id) {
        $subitem = SubItem::find($id);
        return $subitem->delete();
    }

//    public function desativar($id){
//        $subitem = SubItem::find($id);
//        $subitem->status = 0;
//        return $subitem->save();
//    }
}
