<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\SaidaRepository;
use App\progest\repositories\DevolucaoRepository;

class DevolucaoController extends Controller {

    private $saidaRepository;
    private $devolucaoRepository;

    public function __construct(SaidaRepository $saidaRepository, DevolucaoRepository $devolucaoRepository) {
        $this->saidaRepository = $saidaRepository;
        $this->devolucaoRepository = $devolucaoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($saida = null) {
        $devolucoes = $this->devolucaoRepository->index($saida);
        $saida = $this->saidaRepository->show($saida);
        return view('admin.devolucoes.index')->with(compact('devolucoes', 'saida'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($saida) {
        $devolucao = null;
        $saida = $this->saidaRepository->show($saida);
        return view('admin.devolucoes.create')->with(compact(['saida', 'devolucao']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($saida, Request $request) {
        $input['subMateriais'] = $request->only('qtds');
        $input['saida'] = $saida;

        $this->devolucaoRepository->store($input);

        return redirect()->route('admin.saidas.devolucoes.index', [$saida])->with('success', 'Registro inserido com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($idSaida, $idDevolucao) {
        $devolucao = $this->devolucaoRepository->show($idDevolucao);
        return view('admin.devolucoes.show')->with(compact(['devolucao']));
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
    public function destroy($id_saida, $id_devolucao) {
        $this->devolucaoRepository->destroy($id_devolucao);
        return back()->with('success', 'Devolução cancelada com sucesso!');
    }

}
