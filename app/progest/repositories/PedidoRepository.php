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
        $pedido = new Pedido(['obs' => $input['obs'], 'status' => 'Pendente']);
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
        $pedido = Pedido::find($id);
        $pedido->status = $input['status'];
        
        return $empenho->save();
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
