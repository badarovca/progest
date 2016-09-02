<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\SubMaterialRepository;
use App\progest\repositories\RelatorioRepository;
use App\progest\repositories\FornecedorRepository;
use App\progest\repositories\EntradaRepository;
use App\progest\repositories\SaidaRepository;
use App\progest\repositories\CoordenacaoRepository;
use App\progest\repositories\SetorRepository;
use App\progest\repositories\UsuarioRepository;
use App\progest\repositories\EmpenhoRepository;
use App\progest\presenters\EntradaPresenter;
use App\progest\presenters\SaidaPresenter;
use App\progest\presenters\EmpenhoPresenter;
use DB;

class RelatorioController extends Controller {

    protected $materialRepository;
    protected $relatorioRepository;
    protected $subMaterialRepository;
    protected $entradaRepository;
    protected $saidaRepository;
    protected $fornecedorRepository;
    protected $coordenacaoRepository;
    protected $setorRepository;
    protected $usuarioRepository;
    protected $empenhoRepository;

    public function __construct(MaterialRepository $materialRepository, RelatorioRepository $relatorioRepository, SubMaterialRepository $subMaterialRepository, FornecedorRepository $fornecedorRepository, EntradaRepository $entradaRepository, SaidaRepository $saidaRepository, CoordenacaoRepository $coordenacaoRepository, SetorRepository $setorRepository, UsuarioRepository $usuarioRepository, EmpenhoRepository $empenhoRepository) {
        $this->materialRepository = $materialRepository;
        $this->subMaterialRepository = $subMaterialRepository;
        $this->entradaRepository = $entradaRepository;
        $this->saidaRepository = $saidaRepository;
        $this->relatorioRepository = $relatorioRepository;
        $this->fornecedorRepository = $fornecedorRepository;
        $this->coordenacaoRepository = $coordenacaoRepository;
        $this->setorRepository = $setorRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->empenhoRepository = $empenhoRepository;
        $this->anos = [];
        $this->anos[''] = 'Selecione';
        $this->meses = [
            '' => 'Selecione',
            '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril', '05' => 'Maio', '06' => 'Junho',
            '07' => 'Julho', '08' => 'Agosto', '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro'
        ];

        for ($i = (int) date('Y'); $i >= 2016; $i--) {
            $this->anos[$i] = $i;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return back();
    }

    public function getRelatorioContabil(Request $input) {
        $input->flash();
        $anos = $this->anos;
        $meses = $this->meses;
        $data = $input->only('mes', 'ano');
        $dados = ($data['mes'] != null && $data['ano'] != null) ? $this->relatorioRepository->getRelatorioContabil($data) : null;
        $totais = $this->relatorioRepository->getTotais($dados);
        $periodo = date('m/Y', strtotime($data['ano'] . "-" . $data['mes'] . "-01"));
        return view('admin.relatorios.contabil.index')->with(compact(['anos', 'meses', 'dados', 'totais', 'periodo']));
    }

    public function getRelatorioEntradas(Request $input) {
        $input->flash();
        $data = $input->only('dt_inicial', 'dt_final', 'numero', 'fornecedor_id');
        $fornecedores = $this->fornecedorRepository->dataForSelect();
        $data['paginate'] = null;
        $entradas = array_filter($data) ? $this->entradaRepository->index($data) : null;
        if ($entradas != null) {
            $total = EntradaPresenter::CalcTotal($entradas);
            $periodo = $entradas->first()->present()->formatDate($data['dt_inicial']) . " a " . $entradas->first()->present()->formatDate($data['dt_final']);
            $fornecedor = ($data['fornecedor_id']) == null ? null : $this->fornecedorRepository->show($data['fornecedor_id'])->razao;
        }

        return view('admin.relatorios.entradas.index')->with(compact(['entradas', 'fornecedores', 'total', 'periodo', 'fornecedor']));
    }

    public function getRelatorioEntradasMateriais(Request $input) {
        $input->flash();
        $data = $input->only('dt_inicial', 'dt_final', 'solicitante_id', 'setor_id', 'coordenacao_id', 'criterio');
        $users = $this->usuarioRepository->dataForSelect();
        $coordenacoes = $this->coordenacaoRepository->dataForSelect();
        $setores = $this->setorRepository->dataForSelect();
        $data['paginate'] = "null";
        $entradas = array_filter($data) ? $this->entradaRepository->index($data) : null;
        if ($entradas != null && $entradas->first()) {
            $criterios = [
                'setor' => 'Setor',
                'coordenacao' => 'Coordenação',
                'solicitante' => 'Solicitante',
            ];
            $periodo = [
                'dt_inicial' => $entradas->first()->present()->formatDate($data['dt_inicial']),
                'dt_final' => $entradas->first()->present()->formatDate($data['dt_final']),
            ];
            $criterioAtual = $data['criterio'];
            $total = EntradaPresenter::CalcTotal($entradas);
            $entradas = EntradaPresenter::groupBy($data['criterio'], $entradas);
        }
        return view("admin.relatorios.entradas.materiais.relatorio")->with(compact(['entradas', 'users', 'setores', 'coordenacoes', 'total', 'criterios', 'criterioAtual', 'periodo']));
    }

    public function getRelatorioSaidasMateriais(Request $input) {
        $input->flash();
        $data = $input->only('dt_inicial', 'dt_final', 'solicitante_id', 'setor_id', 'coordenacao_id', 'criterio');
        $users = $this->usuarioRepository->dataForSelect();
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
        return view("admin.relatorios.saidas.materiais.relatorio")->with(compact(['saidas', 'users', 'setores', 'coordenacoes', 'total', 'criterios', 'criterioAtual', 'periodo']));
    }

    public function getRelatorioEmpenhos(Request $input) {
        $input->flash();
        $data = $input->only('dt_inicial', 'dt_final', 'solicitante_id', 'setor_id', 'coordenacao_id', 'fornecedor_id', 'status');
        $status = [
            '' => 'Selecione...',
            'pendente' => 'Com pendências',
            'fechado' => 'Sem pendências',
        ];
        $fornecedores = $this->fornecedorRepository->dataForSelect();
        $users = $this->usuarioRepository->dataForSelect();
        $coordenacoes = $this->coordenacaoRepository->dataForSelect();
        $setores = $this->setorRepository->dataForSelect();
        $data['paginate'] = null;
        $empenhos = array_filter($data) ? $this->empenhoRepository->index($data) : null;
        if ($empenhos != null && $empenhos->first()) {
            $filtros = [
                'solicitante_id' => $data['solicitante_id'],
                'setor_id' => $data['setor_id'],
                'coordenacao_id' => $data['coordenacao_id'],
                'fornecedor_id' => $data['fornecedor_id'],
                'status' => $data['status'],
            ];
            $filtros['periodo'] = [
                'dt_inicial' => $empenhos->first()->present()->formatDate($data['dt_inicial']),
                'dt_final' => $empenhos->first()->present()->formatDate($data['dt_final']),
            ];
            $totais = EmpenhoPresenter::calcTotal($empenhos);
        }
        return view("admin.relatorios.empenhos.relatorio")->with(compact(['empenhos', 'users', 'fornecedores', 'setores', 'coordenacoes', 'status', 'filtros', 'totais']));
    }

    public function getRelatorioFornecedores(Request $input) {
        $data['status'] = 'pendente';
        $data['paginate'] = null;
        $fornecedores = array_filter($data) ? $this->fornecedorRepository->index($data) : null;
        return view("admin.relatorios.fornecedores.relatorio")->with(compact(['fornecedores', 'status', 'filtros', 'totais']));
    }

    public function getMesesRelatorio(Request $input, $ano) {
        $meses = [
            '' => 'Selecione',
            '01' => 'Janeiro', '02' => 'Fevereiro', '03' => 'Março', '04' => 'Abril', '05' => 'Maio', '06' => 'Junho',
            '07' => 'Julho', '08' => 'Agosto', '09' => 'Setembro', '10' => 'Outubro', '11' => 'Novembro', '12' => 'Dezembro'
        ];
        if ($ano == date('Y')) {
            for ($i = 12; $i > date('n'); $i--) {
                if ($i > 9) {
                    unset($meses["$i"]);
                } else {
                    unset($meses[sprintf('0%d', $i)]);
                }
            }
        } elseif ($ano > date('Y')) {
            $meses = ['' => 'Selecione um ano válido.'];
        }
        $html = '';
        foreach ($meses as $key => $value) {
            $html .= "<option value='" . $key . "'>$value</option>";
        }
        return response()->json(['success' => true, 'html' => $html]);
    }

}
