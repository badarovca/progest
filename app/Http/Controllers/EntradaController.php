<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\EntradaRepository;
use App\progest\repositories\EmpenhoRepository;
use App\Http\Requests\CriarEntradaRequest;

class EntradaController extends Controller {

    protected $entradaRepository;
    protected $empenhoRepository;

    public function __construct(EntradaRepository $entradaRepository, EmpenhoRepository $empenhoRepository) {
        $this->entradaRepository = $entradaRepository;
        $this->empenhoRepository = $empenhoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($empenho = null) {
        $entradas = $this->entradaRepository->index($empenho);
        $empenho = $this->empenhoRepository->show($empenho);
        return view('admin.entradas.index')->with(compact('entradas', 'empenho'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($empenho) {
        $entrada = null;
        $empenho = $this->empenhoRepository->show($empenho);
        $qtds = $this->empenhoRepository->getQtdsEntregues($empenho);
        return view('admin.entradas.create')->with(compact(['empenho', 'entrada', 'qtds']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($empenho, CriarEntradaRequest $request) {
//        dd($request->all());
        $input['entrada'] = $request->only('num_nf', 'numero_emepenho', 'cod_chave', 'natureza_op', 'dt_emissao', 'dt_recebimento');
        $input['materiais'] = $request->only('qtds');
        $input['empenho'] = $empenho;

        $this->entradaRepository->store($input);

        return redirect()->route('admin.empenhos.entradas.index', [$empenho])->with('success', 'Registro inserido com sucesso!');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($idEmpenho, $idEntrada) {
        $entrada = $this->entradaRepository->show($idEntrada);
        return view('admin.entradas.show')->with(compact(['entrada']));
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
    public function destroy($id_empenho, $id_entrada) {
        $this->entradaRepository->destroy($id_entrada);
        return back()->with('success', 'Entrada cancelada com sucesso!');
    }

}
