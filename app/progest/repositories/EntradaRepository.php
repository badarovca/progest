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
                            if (isset($input['fornecedor_id']) && $input['fornecedor_id'] != null) {
                                $query->whereHas('fornecedor', function ($query) use (&$input) {
                                    $query->where('id', $input['fornecedor_id']);
                                });
                            }
                        });
                    })->get();
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

    public static function CalcTotal($entradas) {
        $total = 0;
        foreach ($entradas as $entrada) {
            foreach ($entrada->subMateriais as $subMaterial) {
                $valorUn = round($subMaterial->vl_total / $subMaterial->qtd_solicitada, 2);
                $total += $valorUn * $subMaterial->pivot->quant;
            }
        }
        $total = number_format($total, 2, ',', '.');
        return $total;
    }

}
