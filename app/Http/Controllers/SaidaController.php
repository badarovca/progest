<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\UsuarioRepository;
use App\progest\repositories\SaidaRepository;
use App\progest\repositories\PedidoRepository;
use App\progest\repositories\CoordenacaoRepository;
use App\progest\repositories\SetorRepository;
use Illuminate\Http\Request;
use App\Http\Requests\CriarSaidaRequest;
use Auth;

class SaidaController extends Controller {

    protected $materialRepository;
    protected $usuarioRepository;
    protected $saidaRepository;
    protected $pedidoRepository;
    protected $coordenacaoRepository;
    protected $setorRepository;

    public function __construct(MaterialRepository $materialRepository, UsuarioRepository $usuarioRepository, SaidaRepository $saidaRepository, PedidoRepository $pedidoRepository, CoordenacaoRepository $coordenacaoRepository, SetorRepository $setorRepository) {
        $this->materialRepository = $materialRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->saidaRepository = $saidaRepository;
        $this->pedidoRepository = $pedidoRepository;
        $this->coordenacaoRepository = $coordenacaoRepository;
        $this->setorRepository = $setorRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $input) {
        $input->flash();
        $filter = $input->all();
        $filter['paginate'] = 50;
        $saidas = $this->saidaRepository->index($filter);
        $users = $this->usuarioRepository->dataForSelect();
        $coordenacoes = $this->coordenacaoRepository->dataForSelect();
        $setores = $this->setorRepository->dataForSelect();

        return view('admin.saidas.index')->with(compact('saidas', 'users', 'coordenacoes', 'setores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $saida = null;
        $users = $this->usuarioRepository->dataForSelect();
        $materiais = $this->materialRepository->dataForSelect(['disp' => 'disponivel']);
        //caso ocorra uma falha na autenticação da saída, buscar materiais e quantidades para mostrar a lista.
        if (old('qtds')) {
            $ids = [];
            $qtds = old('qtds');
            foreach ($qtds as $key => $val) {
                $ids[] = $key;
            }
            $old_materiais = $this->materialRepository->whereIn($ids);
        }
        return view('admin.saidas.create')->with(compact(['saida', 'users', 'materiais', 'old_materiais', 'qtds']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CriarSaidaRequest $request) {
        $input['materiais'] = $request->only('qtds');
        $user = $request->only('email', 'password');
        $input['saida'] = $request->except('qtds', '_token', 'pedido', 'password');
        
        $pedido = $request->only('pedido');
        if ($pedido['pedido'] != null) {
            foreach ($pedido['pedido'] as $key => $val) {
                $status['status'] = $val;
                $input['pedido_id'] = $key;
                $this->pedidoRepository->update($key, $status);
            }
        }else{
            if (!Auth::validate($user)) {
            return back()->withInput()->withErrors(['validacao' => 'Usuário ou senha incorretos.']);
        }
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
        if ($material->present()->getQtdEstoque < $qtd) {
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
