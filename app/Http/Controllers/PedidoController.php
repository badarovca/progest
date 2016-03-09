<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
Use App\progest\repositories\PedidoRepository;
Use App\progest\repositories\MaterialRepository;
Use Cart;
use Illuminate\Http\Request;

class PedidoController extends Controller {

    protected $pedidoRepository;
    protected $materialRepository;

    public function __construct(PedidoRepository $pedidoRepository, MaterialRepository $materialRepository) {
        $this->pedidoRepository = $pedidoRepository;
        $this->materialRepository = $materialRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $pedidos = $this->pedidoRepository->index();
        
        return view('admin.pedidos.index')->with(compact('pedidos'));
    }

    public function exibirMateriais() {
        $materiais = $this->materialRepository->index(['disponivel' => true, 'paginate' => 20]);
        return view('frontend.home')->with(compact('materiais'));
    }
    
    public function exibirPedidos() {
        $pedidos = $this->pedidoRepository->index(['user_id' => Auth::user()->id,  'paginate' => 20]);
        return view('frontend.pedidos.lista-pedidos')->with(compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $input = $request->only('qtds', 'obs');
        $pedido = $this->pedidoRepository->store($input);
        if ($pedido) {
            Cart::destroy();
            return redirect()->route('pedidos')->with('success', 'Pedido realizado com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $pedido = $this->pedidoRepository->show($id);
        if($pedido->status == 'Pendente'){
            return view('admin.pedidos.create-saida')->with(compact('pedido'));
        }else{
            return view('admin.pedidos.show')->with(compact('pedido'));
        } 
    }
    
    public function show_solicitante($id) {
        $pedido = $this->pedidoRepository->show($id);
        return view('frontend.pedidos.show')->with(compact('pedido'));
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
        //
    }

    public function search(Request $request) {
        $busca = $request->only('busca');
        $materiais = $this->materialRepository->index(['disponivel' => true, 'busca' => $busca['busca'], 'paginate' => 20]);
        return view('frontend.home')->with(compact('materiais', 'busca'));
    }

    public function addMaterial(Request $request) {
        $input = $request->only('qtd');
        foreach ($input['qtd'] as $id => $qtd) {
            $material = $this->materialRepository->show($id);
            Cart::add(array('id' => $id, 'qty' => $qtd, 'name' => $material->descricao, 'price' => 0));
        }

        return redirect()->route('pedidos')->with('success', 'Item adicionado ao pedido!');
    }

    public function getPedidoAtual() {
        $itens = Cart::content();
        return view('frontend.pedidos.pedido-atual')->with(compact('itens'));
    }

    public function removeMaterial($rowId) {
        Cart::remove($rowId);
        return back()->with('success', 'Item removido com sucesso!');
    }

}
