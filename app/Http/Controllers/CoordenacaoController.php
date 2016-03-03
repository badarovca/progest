<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\CoordenacaoRepository;

class CoordenacaoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $coordenacaoRepository;

    public function __construct(CoordenacaoRepository $userRepository) {
        $this->coordenacaoRepository = $userRepository;
    }

    public function index() {
        $coordenacoes = $this->coordenacaoRepository->index();

        return view('admin.coordenacoes.index')->with(compact('coordenacoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $coordenacao = null;
        return view('admin.coordenacoes.create')->with(compact('coordenacao'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->coordenacaoRepository->store($request->all());
        return redirect()->route('admin.coordenacoes.index')->with('success', 'Registro inserido com sucesso!');
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
        $coordenacao = $this->coordenacaoRepository->show($id);
        return view('admin.coordenacoes.edit')->with(compact('coordenacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->coordenacaoRepository->update($id, $request->all());
        return redirect()->route('admin.coordenacoes.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->coordenacaoRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }
    
    public function desativar($id) {
        $this->coordenacaoRepository->desativar($id);
        return back()->with('success', 'Desativado com sucesso!');
    }

}
