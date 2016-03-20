<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\UnidadeRepository;
use App\Http\Requests\CriarUnidadeRequest;

class UnidadeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $unidadeRepository;

    public function __construct(UnidadeRepository $unidadeRepository) {
        $this->unidadeRepository = $unidadeRepository;
    }

    public function index() {
        $unidades = $this->unidadeRepository->index();

        return view('admin.unidades.index')->with(compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $unidade = null;
        return view('admin.unidades.create')->with(compact('unidade'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriarUnidadeRequest $request) {
        $this->unidadeRepository->store($request->all());
        return redirect()->route('admin.unidades.index')->with('success', 'Registro inserido com sucesso!');
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
        $unidade = $this->unidadeRepository->show($id);
        return view('admin.unidades.edit')->with(compact('unidade'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->unidadeRepository->update($id, $request->all());
        return redirect()->route('admin.unidades.index')->with('success', 'Registro atualizado com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->unidadeRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }
    
//    public function desativar($id) {
//        $this->unidadeRepository->desativar($id);
//        return back()->with('success', 'Desativado com sucesso!');
//    }

}
