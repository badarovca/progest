<?php

namespace App\progest\repositories;

use App\Empenho;
use App\Material;
use App\SubMaterial;
use App\Entrada;

class EntradaRepository {

    protected $materialRepository;

    public function __construct(MaterialRepository $materialRepository) {
        $this->materialRepository = $materialRepository;
    }

    public function index($empenho = null) {
        if ($empenho == null) {
            return Entrada::all()->sortBy('creatated_at');
        } else {
            return Entrada::where('empenho_id', $empenho)->orderBy('created_at', 'asc')->get();
        }
    }

    public function store($input) {
        $entrada = new Entrada($input['entrada']);

        $empenho = Empenho::find($input['empenho']);
        $entrada->empenho()->associate($empenho);

        $entrada->save();
        $subMateriais = [];
        foreach ($input['subMateriais']['qtds'] as $key => $val) {
            $subMateriais[$key] = ['quant' => $val];
        }

        $entrada->subMateriais()->sync($subMateriais);

        foreach ($subMateriais as $key => $val) {
            $subMaterial = SubMaterial::find($key);
            $subMaterial->qtd_estoque += $val['quant'];
            $subMaterial->save();
        }

        return $entrada;
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
        return Entrada::findOrFail($id);
    }

    public function destroy($id) {
        $entrada = Entrada::find($id);

        foreach ($entrada->subMateriais as $subMaterial) {
            $subMaterial->qtd_estoque -= $subMaterial->pivot->quant;
            $subMaterial->save();
        }
        return $entrada->delete();
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
