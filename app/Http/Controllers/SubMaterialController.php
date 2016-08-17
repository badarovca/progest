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

class SubMaterialController extends Controller {

    protected $subMaterialRepository;

    public function __construct(SubMaterialRepository $subMaterialRepository, SubItemrepository $subItemRepository) {
        $this->subMaterialRepository = $subMaterialRepository;
        $this->subItemRepository = $subItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FilterMaterialRequest $input) {
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriarMaterialRequest $request) {
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $submaterial = $this->subMaterialRepository->show($id);
        $subitens = $this->subItemRepository->dataForSelect();
        return view('admin.submateriais.edit')->with(compact(['submaterial', 'subitens']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->subMaterialRepository->update($id, $request->all());
        return redirect()->route('admin.materiais.edit', $id)->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        return back();
    }
    
    public function buscarMateriais(Request $request, $param){
        return back();
    }

}
