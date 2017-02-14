<?php

namespace App\progest\repositories;

use App\Material;
use App\SubMaterial;
use App\SubItem;
use App\Unidade;
use App\progest\repositories\ImagemRepository;
use App\progest\repositories\RelatorioRepository;

class MaterialRepository {

    protected $imagemRepository;
    protected $relatorioRepository;

    public function __construct(ImagemRepository $imagemRepository, RelatorioRepository $relatorioRepository) {
        $this->imagemRepository = $imagemRepository;
        $this->relatorioRepository = $relatorioRepository;
    }

    public function dataForSelect($filter = null) {
        if ($filter) {
            $baseArray = Material::where(function($query) use (&$filter) {
                                if ($filter['disp'] && $filter['disp'] == 'disponivel') {
                                    $query->where('disponivel', '=', 1);
                                }
                            })
                            ->whereHas('subMateriais', function ($query) use (&$filter) {
                                if ($filter['disp'] && $filter['disp'] == 'disponivel') {
                                    $query->where('qtd_estoque', '>', 0);
                                }
                            })->get();
        } else {
            $baseArray = Material::all();
        }
        $materiais = array('' => 'Selecione...');
        foreach ($baseArray as $value) {
            $materiais[$value->id] = $value->descricao . " - " . $value->marca . " (cod: $value->codigo)";
        }
        return $materiais;
    }

    public function index($filter = null) {
        if ($filter) {
            $orderBy = isset($filter['order']) && $filter['order'] != '' ? explode('-', $filter['order']) : ['descricao', 'asc'];
//            dd($orderBy);
            $materiais = Material::where(function($query) use (&$filter) {
                        if (isset($filter['disp'])) {
                            if ($filter['disp'] == 'disponivel') {
                                $query->where('disponivel', '=', 1)
                                ->where(function($query) use (&$filter) {
                                    if (isset($filter['busca']) && $filter['busca'] != '') {
                                        $query->where('descricao', 'like', "%" . $filter['busca'] . "%")
                                        ->orWhere('marca', 'like', "%" . $filter['busca'] . "%")
                                        ->orWhere('codigo', 'like', "%" . $filter['busca'] . "%");
                                    }
                                });
                            }
                            if ($filter['disp'] == 'indisponivel') {
                                $query->where('disponivel', '=', 0)
                                ->where(function($query) use (&$filter) {
                                    if (isset($filter['busca']) && $filter['busca'] != '') {
                                        $query->where('descricao', 'like', "%" . $filter['busca'] . "%")
                                        ->orWhere('marca', 'like', "%" . $filter['busca'] . "%")
                                        ->orWhere('codigo', 'like', "%" . $filter['busca'] . "%");
                                    }
                                });
                            }
                        }
                        if (isset($filter['busca']) && $filter['busca'] != '') {
                            $query->where('descricao', 'like', "%" . $filter['busca'] . "%")
                            ->orWhere('marca', 'like', "%" . $filter['busca'] . "%")
                            ->orWhere('codigo', 'like', "%" . $filter['busca'] . "%");
                        }
                    })
                    ->whereHas('subMateriais', function ($query) use (&$filter) {
                        if (isset($filter['estq']) && $filter['estq'] == 'em_estq') {
                            $query->where('qtd_estoque', '>', 0);
                        }
                        if (isset($filter['estq']) && $filter['estq'] == 'sem_estq') {
                            $query->groupBy('material_id');
                            $query->havingRaw('SUM(qtd_estoque) <= 0');
                        }
                        if (isset($filter['qtd_min']) && $filter['qtd_min'] == 'acima_qtd_min') {
                            $query->groupBy('material_id');
                            $query->havingRaw('SUM(qtd_estoque) > materials.qtd_min');
                        }
                        if (isset($filter['qtd_min']) && $filter['qtd_min'] == 'abaixo_qtd_min') {
                            $query->groupBy('material_id');
                            $query->havingRaw('SUM(qtd_estoque) <= materials.qtd_min');
                        }
                    })
                    ->orderBy($orderBy[0], $orderBy[1])
                    ->paginate($filter['paginate'] == "null" ? null : $filter['paginate']);
        } else {
            $materiais = Material::all();
        }
//        dd($materiais);
        return $materiais;
    }

    public function store($input) {
        $material = new Material();
        $material->codigo = $input['codigo'];
        $material->descricao = $input['descricao'];
        $material->marca = $input['marca'];
        $material->disponivel = isset($input['disponivel']) ? 1 : 0;
        $material->vencimento = isset($input['vencimento']) ? $input['vencimento'] : null;
        $material->qtd_min = $input['qtd_min'];
        $material->imagem = '';
        if (isset($input['imagem'])) {
            $thumbs = [
                ['width' => '400', 'height' => '400'],
                ['width' => '100', 'height' => '100'],
            ];
            $material->imagem = $this->imagemRepository->sendImage($input['imagem'], 'img/materiais/', $thumbs);
        }


        $subItem = SubItem::find($input['sub_item_id']);
        $material->subItem()->associate($subItem);

        $unidade = Unidade::find($input['unidade_id']);
        $material->unidade()->associate($unidade);

        $material->save();
    }

    public function update($id, $input) {
        $material = Material::find($id);
        $material->codigo = $input['codigo'];
        $material->descricao = $input['descricao'];
        $material->marca = $input['marca'];
        $material->disponivel = isset($input['disponivel']) ? 1 : 0;
        $material->vencimento = isset($input['vencimento']) ? $input['vencimento'] : null;
        $material->qtd_min = $input['qtd_min'];
        if (isset($input['imagem'])) {
            $thumbs = [
                ['width' => '400', 'height' => '400'],
                ['width' => '100', 'height' => '100'],
            ];
            $material->imagem = $this->imagemRepository->sendImage($input['imagem'], 'img/materiais/', $thumbs);
        }

//        $subItem = SubItem::find($input['sub_item_id']);
//        $material->subItem()->associate($subItem);

        $unidade = Unidade::find($input['unidade_id']);
        $material->unidade()->associate($unidade);

        return $material->save();
    }

    public function show($id) {
        return Material::findOrFail($id);
    }

    public function destroy($id) {
        $material = Material::find($id);
        return $material->delete();
    }

    public function search($param) {
        $materiais = Material::where('descricao', 'like', "%$param%")->orWhere('marca', 'like', "%$param%")->get();
        return $materiais;
    }

    public function whereIn($ids = array()) {
        $materiais = Material::whereIn('id', $ids)->get();
        return $materiais;
    }

}
