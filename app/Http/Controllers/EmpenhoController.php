<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\EmpenhoRepository;
use App\progest\repositories\FornecedorRepository;
use App\progest\repositories\SubItemRepository;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\UnidadeRepository;

class EmpenhoController extends Controller {

    protected $empenhoRepository;
    protected $fornecedorRepository;
    protected $subItemRepository;
    protected $materialRepository;
    protected $unidadeRepository;

    public function __construct(EmpenhoRepository $empenhoRepository, FornecedorRepository $fornecedorRepository, SubItemRepository $subItemRepository, MaterialRepository $materialRepository, UnidadeRepository $unidadeRepository) {
        $this->empenhoRepository = $empenhoRepository;
        $this->fornecedorRepository = $fornecedorRepository;
        $this->subItemRepository = $subItemRepository;
        $this->materialRepository = $materialRepository;
        $this->unidadeRepository = $unidadeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $empenhos = $this->empenhoRepository->index();

        return view('admin.empenhos.index')->with(compact('empenhos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $empenho = null;
        $fornecedores = $this->fornecedorRepository->dataForSelect();
        $materiais = $this->materialRepository->dataForSelect();
        return view('admin.empenhos.create')->with(compact(['empenho', 'fornecedores', 'materiais']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input['empenho'] = $request->except('_token', 'codigo', 'descricao', 'marca', 'sub_item_id', 'vl_total', 'quant', 'ids_materiais');
        $input['materiais'] = $request->only('codigo', 'descricao', 'unidade_id', 'marca', 'sub_item_id', 'vl_total', 'quant');
        $input['qtds'] = $request->only('qtds');
        $input['valores_materiais'] = $request->only('valores_materiais');
        $this->empenhoRepository->store($input);
        return redirect()->route('admin.empenhos.index')->with('success', 'Registro inserido com sucesso!');
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
        $empenho = $this->empenhoRepository->show($id);
        if ($empenho->entradas()->count() > 0) {
            return back();
        }
        $fornecedores = $this->fornecedorRepository->dataForSelect();
        $materiais = $this->materialRepository->dataForSelect();
        return view('admin.empenhos.edit')->with(compact(['empenho', 'fornecedores', 'materiais']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $input['empenho'] = $request->except('_token', 'codigo', 'descricao', 'marca', 'sub_item_id', 'vl_total', 'quant', 'ids_materiais');
        $input['materiais'] = $request->only('codigo', 'descricao', 'unidade_id', 'marca', 'sub_item_id', 'vl_total', 'quant');
        $input['qtds'] = $request->only('qtds');
        $input['valores_materiais'] = $request->only('valores_materiais');
        $this->empenhoRepository->update($id, $input);
        return redirect()->route('admin.empenhos.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $empenho = $this->empenhoRepository->show($id);
        if ($empenho->entradas()->count() > 0) {
            return back();
        }
        $this->empenhoRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }

    /**
     * Busca a view com o formulário dinamico para criação de um novo material
     *
     * @return view
     */
    public function getFormMaterial() {
        $subitens = $this->subItemRepository->dataForSelect();
        $unidades = $this->unidadeRepository->dataForSelect();
        $returnHTML = view('admin.empenhos.form-material')->with(compact('subitens', 'unidades'))->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

}
