<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\SetorRepository;
use App\progest\repositories\CoordenacaoRepository;
Use App\Http\Requests\CriarSetorRequest;

class SetorController extends Controller {

    protected $setorRepository;
    protected $coordenacaoRepository;

    public function __construct(SetorRepository $userRepository, CoordenacaoRepository $coordenacaoRepository) {
        $this->setorRepository = $userRepository;
        $this->coordenacaoRepository = $coordenacaoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $input) {
        $input->flash();
        $input = $input->all();
        $filter = $input;
        $filter['paginate'] = 50;
        $setores = $this->setorRepository->index($filter);

        return view('admin.setores.index')->with(compact('setores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $coordenacoes = $this->coordenacaoRepository->dataForSelect();
        $setor = null;
        return view('admin.setores.create')->with(compact('setor', 'coordenacoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CriarSetorRequest $request) {
        $this->setorRepository->store($request->all());
        return redirect()->route('admin.setores.index')->with('success', 'Registro inserido com sucesso!');
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
        $setor = $this->setorRepository->show($id);
        $coordenacoes = $this->coordenacaoRepository->dataForSelect();
        return view('admin.setores.edit')->with(compact('setor','coordenacoes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->setorRepository->update($id, $request->all());
        return redirect()->route('admin.setores.index')->with('success', 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $this->setorRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }
    
//    public function desativar($id) {
//        $this->setorRepository->desativar($id);
//        return back()->with('success', 'Desativado com sucesso!');
//    }

}
