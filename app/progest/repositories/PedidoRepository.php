<?php

namespace App\progest\repositories;

use App\Material;
use App\Pedido;
use App\User;

class PedidoRepository {

    protected $materialRepository;

    public function __construct(MaterialRepository $materialRepository) {
        $this->materialRepository = $materialRepository;
    }

    public function index($empenho = null) {
        return Pedido::all();
    }

    public function store($input) {
        $pedido = new Pedido(['obs' => $input['obs']]);
        $usuario = User::find(1);

        $pedido->solicitante()->associate($usuario);
        
        $pedido->save();

        foreach ($input['qtds'] as $key => $val) {
            $materiais[$key] = ['quant' => $val];
        }

        $pedido->materiais()->sync($materiais);

        return $pedido;
    }

    public function update($id, $input) {
//        $empenho = Empenho::find($id);
//        $empenho->numero = $input['numero'];
//        $empenho->tipo = $input['tipo'];
//        $empenho->cat_despesa = $input['cat_despesa'];
//        $empenho->mod_aplicacao = $input['mod_aplicacao'];
//        $empenho->el_consumo = $input['el_consumo'];
//        $empenho->mod_licitacao = $input['mod_licitacao'];
//        $empenho->num_processo = $input['num_processo'];
//        $empenho->solicitantes = $input['solicitantes'];
//
//        $fornecedor = Fornecedor::find($input['fornecedor_id']);
//        $empenho->fornecedor()->associate($fornecedor);
//
//        return $empenho->save();
    }

    public function show($id) {
        return Pedido::findOrFail($id);
    }

    public function destroy($id) {
        $pedido = Pedido::find($id);

        return $pedido->delete();
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
