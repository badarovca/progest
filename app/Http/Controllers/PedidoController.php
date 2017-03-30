<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
Use App\progest\repositories\PedidoRepository;
Use App\progest\repositories\MaterialRepository;
Use App\progest\repositories\CoordenacaoRepository;
Use App\progest\repositories\SetorRepository;
Use App\progest\repositories\UsuarioRepository;
Use App\progest\repositories\SaidaRepository;
use App\progest\presenters\SaidaPresenter;
Use Cart;
use Illuminate\Http\Request;
use App\Http\Requests\PedidoRequest;

class PedidoController extends Controller {

    protected $pedidoRepository;
    protected $materialRepository;
    protected $coordenacaoRepository;
    protected $setorRepository;
    protected $usuarioRepository;
    protected $saidaRepository;

    public function __construct(PedidoRepository $pedidoRepository, MaterialRepository $materialRepository, 
            CoordenacaoRepository $coordenacaoRepository, SetorRepository $setorRepository, UsuarioRepository $usuarioRepository,
            SaidaRepository $saidaRepository) {
        $this->pedidoRepository = $pedidoRepository;
        $this->materialRepository = $materialRepository;
        $this->coordenacaoRepository = $coordenacaoRepository;
        $this->setorRepository = $setorRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->saidaRepository = $saidaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $pedidos = $this->pedidoRepository->index(['paginate' => 50]);

        return view('admin.pedidos.index')->with(compact('pedidos'));
    }

    public function exibirMateriais() {
        $materiais = $this->materialRepository->index(['disp' => 'disponivel', 'estq' => 'em_estq', 'paginate' => 20]);
        return view('frontend.home')->with(compact('materiais'));
    }

    public function exibirPedidos() {
        $pedidos = $this->pedidoRepository->index(['user_id' => Auth::user()->id, 'paginate' => 20]);
        return view('frontend.pedidos.lista-pedidos')->with(compact('pedidos'));
    }

    public function getRelatorioSaidasMateriais(Request $input) {
        $input->flash();
        $data = $input->only('dt_inicial', 'dt_final', 'solicitante_id', 'setor_id', 'coordenacao_id', 'criterio');
        $users = array();
        $users[''] = 'Todos';
        $coordenacoes = $this->coordenacaoRepository->dataForSelect();
        $setores = $this->setorRepository->dataForSelect();
        $data['paginate'] = null;
        $saidas = array_filter($data) ? $this->saidaRepository->index($data) : null;
        if ($saidas != null && $saidas->first()) {
            $criterios = [
                'setor' => 'Setor',
                'coordenacao' => 'Coordenação',
                'solicitante' => 'Solicitante',
            ];
            $periodo = [
                'dt_inicial' => $saidas->first()->present()->formatDate($data['dt_inicial']),
                'dt_final' => $saidas->first()->present()->formatDate($data['dt_final']),
            ];
            $criterioAtual = $data['criterio'];
            $total = SaidaPresenter::CalcTotal($saidas);
            $saidas = SaidaPresenter::groupBy($data['criterio'], $saidas);
        }
        return view("frontend.consumo.materiais.relatorio")->with(compact(['saidas', 'users', 'setores', 'coordenacoes', 'total', 'criterios', 'criterioAtual', 'periodo']));
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
    public function store(PedidoRequest $request) {
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
        if ($pedido->status == 'Pendente') {
            return view('admin.pedidos.create-saida')->with(compact('pedido'));
        } else {
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
        $materiais = $this->materialRepository->index(['disp' => 'disponivel', 'estq' => 'em_estq', 'busca' => $busca['busca'], 'paginate' => 20]);
        return view('frontend.home')->with(compact('materiais', 'busca'));
    }

    public function addMaterial(Request $request) {
        $input = $request->only('qtd');
        foreach ($input['qtd'] as $id => $qtd) {
            $material = $this->materialRepository->show($id);
            Cart::add(array('id' => $id, 'qty' => $qtd, 'name' => $material->descricao, 'price' => 0));
        }

        return redirect()->back()->with('success', 'Item adicionado ao pedido!');
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
