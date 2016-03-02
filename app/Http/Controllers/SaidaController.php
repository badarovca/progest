<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\UsuarioRepository;
use App\progest\repositories\SaidaRepository;
use App\progest\repositories\PedidoRepository;
use Illuminate\Http\Request;

class SaidaController extends Controller {

    protected $materialRepository;
    protected $usuarioRepository;
    protected $saidaRepository;
    protected $pedidoRepository;

    public function __construct(MaterialRepository $materialRepository, UsuarioRepository $usuarioRepository, 
            SaidaRepository $saidaRepository, PedidoRepository $pedidoRepository) {
        $this->materialRepository = $materialRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->saidaRepository = $saidaRepository;
        $this->pedidoRepository = $pedidoRepository;
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
        $materiais = $this->materialRepository->dataForSelect(['disponivel' => true]);
        return view('admin.saidas.create')->with(compact(['saida', 'users', 'materiais']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $input['materiais'] = $request->only('qtds');
        $input['saida'] = $request->except('qtds', '_token', 'pedido');
        $input['pedido'] = $request->only('pedido');
        if($input['pedido'] != null){
            foreach($input['pedido'] as $key=>$val){
                $pedido['status'] = $val;
            }
            $this->pedidoRepository->update($pedido['pedido']);
        }
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
        $saida = $this->saidaRepository->show($id);
        return view('admin.saidas.show')->with(compact(['saida']));
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

    public function addMaterial($material, $qtd) {
        $material = $this->materialRepository->show($material);
        if ($material->qtd_1 < $qtd) {
            $html = "<div class='alert alert-danger alert-dismissible'>"
                    . "<button type='buttom' class='close' data-dismiss='alert' aria-hidden='true'>x</button>"
                    . "Quantidade não disponível no estoque.</div>";
            return response()->json(array('success' => false, 'html' => $html));
        } else {
            $returnHTML = view('admin.saidas.form-add-material')->with(compact('material', 'qtd'))->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

}
