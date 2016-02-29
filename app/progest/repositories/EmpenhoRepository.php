<?php

namespace App\progest\repositories;

use App\Fornecedor;
use App\Empenho;
use App\Material;
use App\SubItem;
use App\Entrada;
use App\Unidade;

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

        if ($input['qtds']['qtds']) {
            $materiais_ids = [];

            foreach ($input['qtds']['qtds'] as $key => $val) {
                $materiais_ids[$key] = ['quant' => $val, 'vl_total' => $input['valores_materiais']['valores_materiais'][$key]];
            }
            $empenho->materiais()->sync($materiais_ids);
        }

        if ($materiais) {
            foreach ($materiais['objects'] as $key => $val) {
                $empenho->materiais()->save($val, $materiais['joinings'][$key]);
            }
        }
    }

    public function update($id, $input) {
        $empenho = Empenho::find($id);
        $empenho->numero = $input['empenho']['numero'];
        $empenho->tipo = $input['empenho']['tipo'];
        $empenho->cat_despesa = $input['empenho']['cat_despesa'];
        $empenho->mod_aplicacao = $input['empenho']['mod_aplicacao'];
        $empenho->el_consumo = $input['empenho']['el_consumo'];
        $empenho->mod_licitacao = $input['empenho']['mod_licitacao'];
        $empenho->num_processo = $input['empenho']['num_processo'];
        $empenho->solicitantes = $input['empenho']['solicitantes'];

        $materiais = $this->preparaDadosMateriais($input['materiais']);

        $fornecedor = Fornecedor::find($input['empenho']['fornecedor_id']);
        $empenho->fornecedor()->associate($fornecedor);
        
        if ($input['qtds']['qtds']) {
            $materiais_ids = [];

            foreach ($input['qtds']['qtds'] as $key => $val) {
                $materiais_ids[$key] = ['quant' => $val, 'vl_total' => $input['valores_materiais']['valores_materiais'][$key]];
            }
            $empenho->materiais()->sync($materiais_ids);
        }

        if ($materiais) {
            foreach ($materiais['objects'] as $key => $val) {
                $empenho->materiais()->save($val, $materiais['joinings'][$key]);
            }
        }

        return $empenho->save();
    }

    public function show($id) {
        return Empenho::find($id);
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
                'marca' => $val['marca'],
                'qtd_1' => 0, 'qtd_2' => 0, 'qtd_3' => 0, 'qtd_4' => 0, 'disponivel' => 0
            ]);

            $subItem = SubItem::find($val['sub_item_id']);
            $materiaisObjects[$key]->subItem()->associate($subItem);
            
            $unidade = Unidade::find($val['unidade_id']);
            $materiaisObjects[$key]->unidade()->associate($unidade);
            
            unset($materiaisArray[$key]['codigo']);
            unset($materiaisArray[$key]['descricao']);
            unset($materiaisArray[$key]['unidade_id']);
            unset($materiaisArray[$key]['marca']);
            unset($materiaisArray[$key]['sub_item_id']);
        }
        $materiais['joinings'] = $materiaisArray;
        $materiais['objects'] = $materiaisObjects;
        return $materiais;
    }

    public function getQtdsEntregues($empenho) {
        foreach ($empenho->materiais as $material) {
            $qtds[$material->id]['qnt_entregue'] = 0;
        }
        foreach ($empenho->entradas as $entrada) {
            foreach ($entrada->materiais as $material) {
                $qtds[$material->id]['qnt_entregue'] += $material->pivot->quant;
            }
        }

        return $qtds;
    }

}
