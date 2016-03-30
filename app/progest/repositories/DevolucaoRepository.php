<?php

namespace App\progest\repositories;

use App\Material;
use App\SubMaterial;
use App\Saida;
use App\Devolucao;

class DevolucaoRepository {

    protected $materialRepository;

    public function __construct(MaterialRepository $materialRepository) {
        $this->materialRepository = $materialRepository;
    }

    public function index($saida = null) {
        if ($saida == null) {
            return Devolucao::orderBy('created_at', 'desc')->paginate(50);
        } else {
            return Devolucao::where('saida_id', $saida)->orderBy('created_at', 'desc')->paginate(50);
        }
    }

    public function store($input) {
        $devolucao = new Devolucao();

        $saida = Saida::find($input['saida']);
        $devolucao->saida()->associate($saida);

        $devolucao->save();
        $subMateriais = [];
        foreach ($input['subMateriais']['qtds'] as $key => $val) {
            $subMateriais[$key] = ['quant' => $val];
        }

        $devolucao->subMateriais()->sync($subMateriais);

        foreach ($subMateriais as $key => $val) {
            $subMaterial = SubMaterial::find($key);
            $subMaterial->qtd_estoque += $val['quant'];
            $subMaterial->save();
        }

        return $devolucao;
    }

    public function update($id, $input) {
        //
    }

    public function show($id) {
        return Devolucao::findOrFail($id);
    }

    public function destroy($id) {
        $devolucao = Devolucao::find($id);

        foreach ($devolucao->subMateriais as $subMaterial) {
            $subMaterial->qtd_estoque -= $subMaterial->pivot->quant;
            $subMaterial->save();
        }
        return $devolucao->delete();
    }

}
