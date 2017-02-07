<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\FilterMaterialRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\SubItemRepository;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\UnidadeRepository;
use App\Http\Requests\CriarMaterialRequest;
use App\progest\repositories\SubMaterialRepository;

class MaterialController extends Controller {

    protected $materialRepository;
    protected $subItemRepository;
    protected $unidadeRepository;
    protected $subMaterialRepository;

    public function __construct(SubItemRepository $subItemRepository, MaterialRepository $materialRepository, UnidadeRepository $unidadeRepository, SubMaterialRepository $subMaterialRepository) {
        $this->subItemRepository = $subItemRepository;
        $this->materialRepository = $materialRepository;
        $this->unidadeRepository = $unidadeRepository;
        $this->subMaterialRepository = $subMaterialRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterMaterialRequest $input) {
        $input->flash();
        $input = $input->all();
        $filter = $input;
        $filter['paginate'] = isset($filter['paginate']) ? $filter['paginate'] : 20;
        $materiais = $this->materialRepository->index($filter);
        $filter = [
        'estq' => [
        '' => 'Selecione...',
        'em_estq' => 'Em estoque',
        'sem_estq' => 'Sem estoque',
        ],
        'disp' => [
        '' => 'Selecione...',
        'disponivel' => 'Disponível',
        'indisponivel' => 'Indisponível',
        ],
        'qtd_min' => [
        '' => 'Selecione...',
        'acima_qtd_min' => 'Acima da quantidade mínima',
        'abaixo_qtd_min' => 'Abaixo da quantidade mínima',
        ],
        'paginate' => [
        '20' => '20',
        '50' => '50',
        '100' => '100',
        '200' => '200',
        ]
        ];


        return view('admin.materiais.index')->with(compact('materiais', 'filter','input'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//        $material = null;
//        $subitens = $this->subItemRepository->dataForSelect();
//        $unidades = $this->unidadeRepository->dataForSelect();
//        return view('admin.materiais.create')->with(compact(['material', 'subitens', 'unidades']));
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriarMaterialRequest $request) {
//        $this->materialRepository->store($request->all());
//        return redirect()->route('admin.materiais.index')->with('success', 'Registro inserido com sucesso!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $material = $this->materialRepository->show($id);
        $subitens = $this->subItemRepository->dataForSelect();
        $unidades = $this->unidadeRepository->dataForSelect();
        $submaterial = $this->subMaterialRepository->index($id);
        return view('admin.materiais.edit')->with(compact(['material', 'subitens', 'unidades', 'submaterial']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->materialRepository->update($id, $request->all());
        return redirect()->route('admin.materiais.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->materialRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }

    public function buscarMateriais(Request $request, $param) {
        dd($this->materialRepository->search($param)->toJson());
    }

}
