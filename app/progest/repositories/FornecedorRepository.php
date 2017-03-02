<?php

namespace App\progest\repositories;

use App\Fornecedor;
use DB;

class FornecedorRepository {

    public function dataForSelect() {
        $baseArray = Fornecedor::all();
        $fornecedores = array();
        $fornecedores[''] = 'Selecione...';
        foreach ($baseArray as $value) {
            if ($value->status == 1) {
                $fornecedores[$value->id] = $value->razao;
            }
        }
        return $fornecedores;
    }

    public function index($input = null) {
//        DB::connection()->enableQueryLog();
        if ($input) {
            $fornecedores = Fornecedor::where(function($query) use ($input) {
                        if (isset($filter['habilitado'])) {
                            $query->where('status', '=', $filter['habilitado']);
                        }
                        if (isset($input['busca']) && $input['busca'] != '') {
                            $query->where('cnpj', 'like', "%" . $input['busca'] . "%")
                                    ->orWhere('razao', 'like', "%" . $input['busca'] . "%")
                                    ->orWhere('fantasia', 'like', "%" . $input['busca'] . "%");
                        }
                        if (isset($input['status']) && $input['status'] != null) {
                            if ($input['status'] == 'fechado') {
                                $query->whereHas('empenhos', function($query) {
                                    $query->where(function($query) {
                                        $query->whereHas('entradas.subMateriais', function ($query) {
                                            $query->havingRaw('SUM(entrada_sub_material.quant) = SUM(qtd_solicitada)');
                                        });
                                    });
                                });
                                $query->whereDoesntHave('empenhos', function($query) {
                                    $query->where(function($query) {
                                        $query->whereHas('subMateriais', function ($query) use (&$input) {
                                            $query->whereHas('entradas', function ($query) use (&$input) {
                                                $query->havingRaw('SUM(entrada_sub_material.quant) != sub_materials.qtd_solicitada');
                                            });
                                        });
                                        $query->orWhere(function($query) {
                                            $query->whereDoesntHave('entradas');
                                        });
                                    });
                                });
                            } else
                            if ($input['status'] == 'pendente') {
                                $query->whereHas('empenhos', function($query) {
                                    $query->where(function($query) {
                                        $query->whereHas('subMateriais', function ($query) use (&$input) {
                                            $query->whereHas('entradas', function ($query) use (&$input) {
                                                $query->havingRaw('SUM(entrada_sub_material.quant) != sub_materials.qtd_solicitada');
                                            });
                                        });
                                        $query->orWhere(function($query) {
                                            $query->whereDoesntHave('entradas');
                                        });
                                    });
                                });
                            }
                        }
                    })->with(['empenhos.subMateriais'])->paginate($input['paginate'] == 'null' ? 1000 : $input['paginate']);
        } else {
            $fornecedores = Fornecedor::paginate(50);
        }
        return $fornecedores;
    }

    public function store($input) {
        $fornecedor = new Fornecedor();
        $fornecedor->fantasia = $input['fantasia'];
        $fornecedor->razao = $input['razao'];
        $fornecedor->endereco = $input['endereco'];
        $fornecedor->email = $input['email'];
        $fornecedor->cnpj = $input['cnpj'];
        $fornecedor->telefone1 = $input['telefone1'];
        $fornecedor->telefone2 = $input['telefone2'];
        $fornecedor->status = isset($input['status']) ? 1 : 0;
        //$fornecedor->status = 1;
        $fornecedor->save();
    }

    public function update($id, $input) {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->fantasia = $input['fantasia'];
        $fornecedor->razao = $input['razao'];
        $fornecedor->endereco = $input['endereco'];
        $fornecedor->email = $input['email'];
        $fornecedor->cnpj = $input['cnpj'];
        $fornecedor->telefone1 = $input['telefone1'];
        $fornecedor->telefone2 = $input['telefone2'];
        $fornecedor->status = isset($input['status']) ? 1 : 0;
        return $fornecedor->save();
    }

    public function show($id) {
        return Fornecedor::findOrFail($id);
    }

    public function destroy($id) {
        $fornecedor = Fornecedor::find($id);
        return $fornecedor->delete();
    }

//    public function desativar($id){
//        $fornecedor = Fornecedor::find($id);
//        $fornecedor->status = 0;
//        return $fornecedor->save();
//    }
}
