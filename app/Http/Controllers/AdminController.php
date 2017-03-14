<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
Use App\progest\repositories\PedidoRepository;
Use App\progest\repositories\EmpenhoRepository;
Use App\progest\repositories\UsuarioRepository;
Use App\progest\repositories\MaterialRepository;

class AdminController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    protected $pedidoRepository;
    protected $empenhoRepository;
    protected $usuarioRepository;
    protected $materialRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PedidoRepository $pedidoRepository, EmpenhoRepository $empenhoRepository, UsuarioRepository $usuarioRepository, MaterialRepository $materialRepository) {
        $this->pedidoRepository = $pedidoRepository;
        $this->empenhoRepository = $empenhoRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->materialRepository = $materialRepository;
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        $qtds = [];
        $qtds['pedidos_pendentes'] = $this->pedidoRepository->index(['status'=>'pendente', 'paginate'=>null])->total();
        $qtds['empenhos_abertos'] = $this->empenhoRepository->index(['status'=>'pendente', 'paginate'=>null])->total();
        $qtds['usuarios'] = $this->usuarioRepository->index(['paginate'=>null])->total();
        $qtds['materiais_abaixo'] = $this->materialRepository->index(['qtd_min' => 'abaixo_qtd_min', 'paginate'=>null])->total();
        return view('admin.home')->with(compact('qtds'));
    }

}
