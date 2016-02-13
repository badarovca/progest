<?php

namespace App\progest\repositories;

use App\Fornecedor;
use App\Empenho;
use App\Material;
use App\SubItem;

class EmpenhoRepository {

    protected $materialRepository;

    public function __construct(MaterialRepository $materialRepository) {
        $this->materialRepository = $materialRepository;
    }

    public function index() {
        return Empenho::all();
    }

    public function store($input) {
        $fornecedor_id = $input['empenho']['fornecedor_id'];
        unset($input['empenho']['fornecedor_id']);
        $empenho = new Empenho($input['empenho']);
        $materiais = $this->preparaDadosMateriais($input['materiais']);

        $fornecedor = Fornecedor::find($fornecedor_id);
        $empenho->fornecedor()->associate($fornecedor);

        $empenho->save();

        $empenho->materiais()->sync($input['ids_materiais']['ids_materiais']);
        if ($materiais) {
            foreach ($materiais['objects'] as $key => $val) {
                $empenho->materiais()->save($val, $materiais['joinings'][$key]);
            }
        }
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

    public function preparaDadosMateriais($input) {
        $materiaisArray = array();
        foreach ($input as $key => $val) {
            if ($val === null) {
                return false;
            }
            foreach ($val as $i => $j) {
                $materiaisArray[$i][$key] = $j;
            }
        }
        $materiaisObjects = array();
        foreach ($materiaisArray as $key => $val) {
            $materiaisObjects[$key] = new Material([
                'codigo' => $val['codigo'], 'descricao' => $val['descricao'],
                'unidade' => $val['unidade'], 'marca' => $val['marca'],
                'qtd_1' => 0, 'qtd_2' => 0, 'qtd_3' => 0, 'qtd_4' => 0, 'disponivel' => 0
            ]);

            $subItem = SubItem::find($val['sub_item_id']);
            $materiaisObjects[$key]->subItem()->associate($subItem);
            unset($materiaisArray[$key]['codigo']);
            unset($materiaisArray[$key]['descricao']);
            unset($materiaisArray[$key]['unidade']);
            unset($materiaisArray[$key]['marca']);
            unset($materiaisArray[$key]['sub_item_id']);
        }
        $materiais['joinings'] = $materiaisArray;
        $materiais['objects'] = $materiaisObjects;
        return $materiais;
    }

}
