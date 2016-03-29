<?php

namespace App\progest\repositories;

use App\Material;
use App\SubItem;
use App\Unidade;
use App\progest\repositories\ImagemRepository;

class MaterialRepository {

    protected $imagemRepository;

    public function __construct(ImagemRepository $imagemRepository) {
        $this->imagemRepository = $imagemRepository;
    }

    public function dataForSelect($filter = null) {
        if ($filter) {
            $baseArray = Material::where(function($query) use (&$filter) {
                                if ($filter['disponivel']) {
                                    $query->where('disponivel', '=', 1);
                                }
                            })
                            ->whereHas('subMateriais', function ($query) use (&$filter) {
                                if ($filter['disponivel']) {
                                    $query->where('qtd_estoque', '>', 0);
                                }
                            })->get();
        } else {
            $baseArray = Material::all();
        }
        $materiais = array('' => 'Selecione...');
        foreach ($baseArray as $value) {
            $materiais[$value->id] = $value->descricao . " (cod: $value->codigo)";
        }
        return $materiais;
    }

    public function index($filter = null) {
        if ($filter) {
            $orderBy = isset($filter['order']) && $filter['order'] != '' ? explode('-', $filter['order']) : ['descricao', 'asc'];
//            dd($orderBy);
            $materiais = Material::where(function($query) use (&$filter) {
                        if (isset($filter['disponivel'])) {
                            $query->where('disponivel', '=', 1);
                        }
                        if (isset($filter['busca']) && $filter['busca'] != '') {
                            $query->where('descricao', 'like', "%" . $filter['busca'] . "%")
                            ->orWhere('marca', 'like', "%" . $filter['busca'] . "%")
                            ->orWhere('codigo', 'like', "%" . $filter['busca'] . "%");
                        }
                        if (isset($filter['qtd_min']) && $filter['qtd_min'] != '') {
                            $query->whereRaw('materials.qtd_1 < materials.qtd_min')
                            ->where('qtd_1', '!=', "")
                            ->where('qtd_min', '!=', "");
                        }
                    })
                    ->whereHas('subMateriais', function ($query) use (&$filter) {
                        if (isset($filter['disponivel'])) {
                            $query->where('qtd_estoque', '>', 0);
                        }
                    })
                    ->whereHas('subitem', function ($query) use (&$filter) {
                        if (isset($filter['subitem']) && $filter['subitem'] != '') {
                            $query->where('sub_item_id', '=', $filter['subitem']);
                        }
                    })
                    ->whereHas('unidade', function ($query) use (&$filter) {
                        if (isset($filter['unidade']) && $filter['unidade'] != '') {
                            $query->where('unidade_id', '=', $filter['unidade']);
                        }
                    })->orderBy($orderBy[0], $orderBy[1])
                    ->paginate($filter['paginate']);
        } else {
            $materiais = Material::all();
        }
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
                ['width' => '100', 'height' => '100'],
                ['width' => '400', 'height' => '400'],
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
                ['width' => '100', 'height' => '100'],
                ['width' => '400', 'height' => '400'],
            ];
            $material->imagem = $this->imagemRepository->sendImage($input['imagem'], 'img/materiais/', $thumbs);
        }

        $subItem = SubItem::find($input['sub_item_id']);
        $material->subItem()->associate($subItem);

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

}
