<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\SubItemRepository;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\UnidadeRepository;

class MaterialController extends Controller {

    protected $materialRepository;
    protected $subItemRepository;
    protected $unidadeRepository;
    

    public function __construct(SubItemRepository $subItemRepository, MaterialRepository $materialRepository, 
     UnidadeRepository $unidadeRepository) {
        $this->subItemRepository = $subItemRepository;
        $this->materialRepository = $materialRepository;
        $this->unidadeRepository = $unidadeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $input) {
        $input->flash();
        $input = $input->all();
        $input['paginate'] = 20;
        $materiais = $this->materialRepository->index($input);
        $unidades = $this->unidadeRepository->dataForSelect();
        $subitens = $this->subItemRepository->dataForSelect();
        return view('admin.materiais.index')->with(compact('materiais', 'unidades', 'subitens'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $material = null;
        $subitens = $this->subItemRepository->dataForSelect();
        $unidades = $this->unidadeRepository->dataForSelect();
        return view('admin.materiais.create')->with(compact(['material', 'subitens', 'unidades']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->materialRepository->store($request->all());
        return redirect()->route('admin.materiais.index')->with('success', 'Registro inserido com sucesso!');
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
        return view('admin.materiais.edit')->with(compact(['material', 'subitens', 'unidades']));
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
    
    public function buscarMateriais(Request $request, $param){
        dd($this->materialRepository->search($param)->toJson());
    }

}
