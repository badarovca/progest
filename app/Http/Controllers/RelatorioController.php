<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\SubMaterialRepository;
use App\progest\repositories\RelatorioRepository;

class RelatorioController extends Controller {
    
    protected $materialRepository;
    protected $relatorioRepository;
    
    public function __construct(MaterialRepository $materialRepository, RelatorioRepository $relatorioRepository, SubMaterialRepository $subMaterialRepository) {
        $this->materialRepository = $materialRepository;
        $this->subMaterialRepository = $subMaterialRepository;
        $this->relatorioRepository = $relatorioRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return back();
    }

    public function getRelatorioContabil(Request $input){
        $anos = [];
        $anos[''] = 'Selecione';
        $meses = [
            '' => 'Selecione',
            '01'=>'Janeiro', '02'=>'Fevereiro', '03'=>'Março', '04'=>'Abril', '05'=>'Maio', '06'=>'Junho',
            '07'=>'Julho', '08'=>'Agosto', '09'=>'Setembro', '10'=>'Outubro', '11'=>'Novembro', '12'=>'Dezembro'
            ];
        
        for ($i = 2012; $i<=(int) date('Y'); $i++){
            $anos[$i] = $i;
        }
        $data = $input->only('mes', 'ano');
        $dados = ($data['mes'] != null && $data['ano'] != null) ? $this->relatorioRepository->getRelatorioContabil($data) : null;
        return view('admin.relatorios.contabil.index')->with(compact(['anos', 'meses', 'dados', 'totais']));
    }
}


