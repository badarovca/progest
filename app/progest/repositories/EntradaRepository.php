<?php

namespace App\progest\repositories;

use App\Empenho;
use App\Material;
use App\SubMaterial;
use App\Entrada;
use App\Saldo;

class EntradaRepository {

    protected $materialRepository;
    protected $relatorioRepository;

    public function __construct(MaterialRepository $materialRepository, RelatorioRepository $relatorioRepository) {
        $this->materialRepository = $materialRepository;
        $this->relatorioRepository = $relatorioRepository;
    }

    public function index($input = null) {
        if ($input == null) {
            return Entrada::orderBy('created_at', 'desc')->paginate(50);
        } else {
            $entradas = Entrada::where(function($query) use (&$input) {
                        if (isset($input['dt_inicial']) && isset($input['dt_final']) && $input['dt_inicial'] != null && $input['dt_final'] != null) {
                            $query->whereBetween('dt_recebimento', [$input['dt_inicial'], $input['dt_final']]);
                        }
                        $query->whereHas('empenho', function ($query) use (&$input) {
                            if (isset($input['numero']) && $input['numero'] != null) {
                                $query->where('numero', $input['numero']);
                            }
                            if (isset($input['empenho_id']) && $input['empenho_id'] != null) {
                                $query->where('id', $input['empenho_id']);
                            }
                            if (isset($input['fornecedor_id']) && $input['fornecedor_id'] != null) {
                                $query->whereHas('fornecedor', function ($query) use (&$input) {
                                    $query->where('id', $input['fornecedor_id']);
                                });
                            }
                            if (isset($input['solicitante_id']) && $input['solicitante_id'] != null) {
                                $query->whereHas('solicitante', function ($query) use (&$input) {
                                    $query->where('id', $input['solicitante_id']);
                                });
                            }
                            if (isset($input['setor_id']) && $input['setor_id'] != null) {
                                $query->whereHas('solicitante', function ($query) use (&$input) {
                                    $query->whereHas('setor', function($query) use (&$input) {
                                        $query->where('id', $input['setor_id']);
                                    });
                                });
                            }
                            if (isset($input['coordenacao_id']) && $input['coordenacao_id'] != null) {
                                $query->whereHas('solicitante', function ($query) use (&$input) {
                                    $query->whereHas('setor', function($query) use (&$input) {
                                        $query->whereHas('coordenacao', function($query) use (&$input) {
                                            $query->where('id', $input['coordenacao_id']);
                                        });
                                    });
                                });
                            }
                        });
                    })->with(['subMateriais.material', 'subMateriais.empenho', 'empenho.solicitante.setor.coordenacao'])->orderBy('created_at', 'desc')->paginate($input['paginate'] == "null" ? null : $input['paginate']);
            return $entradas;
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
            $valor = (round($subMaterial->vl_total / $subMaterial->qtd_solicitada, 2) * $val['quant']);
            $this->relatorioRepository->updateSaldo($subMaterial, $valor);
        }

        return $entrada;
    }

    public function update($id, $input) {
        
    }

    public function show($id) {
        return Entrada::findOrFail($id);
    }

    public function destroy($id) {
        $entrada = Entrada::find($id);

        foreach ($entrada->subMateriais as $subMaterial) {
            $valor = "-" . (round($subMaterial->vl_total / $subMaterial->qtd_solicitada, 2) * $subMaterial->pivot->quant);
            $this->relatorioRepository->updateSaldo($subMaterial, $valor);
            $subMaterial->qtd_estoque -= $subMaterial->pivot->quant;
            $subMaterial->save();
        }
        return $entrada->delete();
    }

}
