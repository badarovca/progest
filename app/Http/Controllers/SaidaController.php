<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\UsuarioRepository;
use App\progest\repositories\SaidaRepository;
use Illuminate\Http\Request;

class SaidaController extends Controller {

    protected $materialRepository;
    protected $usuarioRepository;
    protected $saidaRepository;

    public function __construct(MaterialRepository $materialRepository, UsuarioRepository $usuarioRepository, SaidaRepository $saidaRepository) {
        $this->materialRepository = $materialRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->saidaRepository = $saidaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $saidas = $this->saidaRepository->index();

        return view('admin.saidas.index')->with(compact('saidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $saida = null;
        $users = $this->usuarioRepository->dataForSelect();
        $materiais = $this->materialRepository->dataForSelect();
        return view('admin.saidas.create')->with(compact(['saida', 'users', 'materiais']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $input['materiais'] = $request->only('qtds');
        $input['saida'] = $request->except('qtds', '_token');
        $this->saidaRepository->store($input);

        return redirect()->route('admin.saidas.index')->with('success', 'Saída efetuada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $this->saidaRepository->destroy($id);
        return back()->with('success', 'Removido com sucesso!');
    }

}
