<?php

namespace App\progest\repositories;

use App\Fornecedor;
use App\Empenho;
use App\Material;
use App\SubItem;
use App\Entrada;
use App\Unidade;
use App\progest\repositories\ImagemRepository;

class EmpenhoRepository {

    protected $materialRepository;
    protected $imagemRepository;

    public function __construct(MaterialRepository $materialRepository, ImagemRepository $imagemRepository) {
        $this->materialRepository = $materialRepository;
        $this->imagemRepository = $imagemRepository;
    }

    public function index() {
        return Empenho::all()->sortBy('creatated_at');
    }

    public function store($input) {
        $fornecedor_id = $input['empenho']['fornecedor_id'];
        $solicitante_id = $input['empenho']['solicitante_id'];
        unset($input['empenho']['fornecedor_id']);
        unset($input['empenho']['solicitante_id']);
        $empenho = new Empenho($input['empenho']);
        $input['materiais']['vl_total'] = $this->realToDolar($input['materiais']['vl_total']);
//        dd($input['materiais']);
        $materiais = $this->preparaDadosMateriais($input['materiais']);

        $fornecedor = Fornecedor::find($fornecedor_id);
        $solicitante = Fornecedor::find($solicitante_id);

        $empenho->fornecedor()->associate($fornecedor);
        $empenho->solicitante()->associate($solicitante);

        $empenho->save();

        if ($input['qtds']['qtds']) {
            $materiais_ids = [];

            foreach ($input['qtds']['qtds'] as $key => $val) {
                $vl_total = $this->realToDolar($input['valores_materiais']['valores_materiais'][$key]);
                $materiais_ids[$key] = ['quant' => $val, 'vl_total' => $vl_total];
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

        $input['materiais']['vl_total'] = $this->realToDolar($input['materiais']['vl_total']);
        $materiais = $this->preparaDadosMateriais($input['materiais']);

        $fornecedor = Fornecedor::find($input['empenho']['fornecedor_id']);
        $solicitante = Fornecedor::find($input['empenho']['solicitante_id']);

        $empenho->fornecedor()->associate($fornecedor);
        $empenho->solicitante()->associate($solicitante);
        

        if ($input['qtds']['qtds']) {
            $materiais_ids = [];

            foreach ($input['qtds']['qtds'] as $key => $val) {
                $vl_total = $this->realToDolar($input['valores_materiais']['valores_materiais'][$key]);
                $materiais_ids[$key] = ['quant' => $val, 'vl_total' => $vl_total];
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

    public function realToDolar($input) {

        if (is_array($input)) {
            foreach ($input as $key => $val) {
                $input[$key] = str_replace(',', '.', str_replace('.', '', $val));
            }
        } else {
            $input = str_replace(',', '.', str_replace('.', '', $input));
        }

        return $input;
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
                'marca' => $val['marca'], 'vencimento' => isset($val['vencimento']) ? $val['vencimento'] : null,
                'qtd_min' => $val['qtd_min'], 'imagem' => '',
                'qtd_1' => 0, 'qtd_2' => 0, 'qtd_3' => 0, 'qtd_4' => 0, 'disponivel' => 0
            ]);

            if (isset($val['imagem'])) {
                $thumbs = [
                    ['width' => '100', 'height' => '100'],
                    ['width' => '400', 'height' => '400'],
                ];
                $materiaisObjects[$key]->imagem = $this->imagemRepository->sendImage($val['imagem'], 'img/materiais/', $thumbs);
            }

            $subItem = SubItem::find($val['sub_item_id']);
            $materiaisObjects[$key]->subItem()->associate($subItem);

            $unidade = Unidade::find($val['unidade_id']);
            $materiaisObjects[$key]->unidade()->associate($unidade);

            unset($materiaisArray[$key]['codigo']);
            unset($materiaisArray[$key]['descricao']);
            unset($materiaisArray[$key]['unidade_id']);
            unset($materiaisArray[$key]['marca']);
            unset($materiaisArray[$key]['sub_item_id']);
            unset($materiaisArray[$key]['imagem']);
            unset($materiaisArray[$key]['vencimento']);
            unset($materiaisArray[$key]['qtd_min']);
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
