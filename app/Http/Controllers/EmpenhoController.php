<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\EmpenhoRepository;
use App\progest\repositories\FornecedorRepository;
use App\progest\repositories\SubItemRepository;

class EmpenhoController extends Controller {

    protected $empenhoRepository;
    protected $fornecedorRepository;
    protected $subItemRepository;

    public function __construct(EmpenhoRepository $empenhoRepository, FornecedorRepository $fornecedorRepository, SubItemRepository $subItemRepository) {
        $this->empenhoRepository = $empenhoRepository;
        $this->fornecedorRepository = $fornecedorRepository;
        $this->subItemRepository = $subItemRepository;
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
        return view('admin.empenhos.create')->with(compact(['empenho', 'fornecedores']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $input['empenho'] = $request->except('_token', 'codigo', 'descricao', 'unidade', 'marca', 'sub_item_id', 'vl_total', 'quant');
        $input['materiais'] = $request->only('codigo', 'descricao', 'unidade', 'marca', 'sub_item_id', 'vl_total', 'quant');
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
        $fornecedores = $this->fornecedorRepository->dataForSelect();
        return view('admin.empenhos.edit')->with(compact(['empenho', 'fornecedores']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->empenhoRepository->update($id, $request->all());
        return redirect()->route('admin.empenhos.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
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
        $returnHTML = view('admin.empenhos.form-material')->with(compact('subitens'))->render();
        return response()->json(array('success' => true, 'html' => $returnHTML));
    }

}
