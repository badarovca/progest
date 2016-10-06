<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\progest\repositories\EmpenhoRepository;
use App\progest\repositories\EntradaRepository;
use App\progest\repositories\FornecedorRepository;
use App\progest\repositories\SubItemRepository;
use App\progest\repositories\MaterialRepository;
use App\progest\repositories\UsuarioRepository;
use App\Empenho;
use App\Fornecedor;
use App\Material;
use App\SubMaterial;

class ImportacaoController extends Controller {

    protected $empenhoRepository;
    protected $entradaRepository;
    protected $fornecedorRepository;
    protected $subItemRepository;
    protected $materialRepository;
    protected $usuarioRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmpenhoRepository $empenhoRepository, EntradaRepository $entradaRepository, 
            FornecedorRepository $fornecedorRepository, SubItemRepository $subItemRepository, 
            MaterialRepository $materialRepository, 
            UsuarioRepository $usuarioRepository) {
        $this->empenhoRepository = $empenhoRepository;
        $this->entradaRepository = $entradaRepository;
        $this->fornecedorRepository = $fornecedorRepository;
        $this->subItemRepository = $subItemRepository;
        $this->materialRepository = $materialRepository;
        $this->usuarioRepository = $usuarioRepository;
    }

    public function importData() {
        $file = Excel::load(storage_path('ESTOQUE ATUALIZADO.xlsx'), function($reader) {
                    
                })->ignoreEmpty()->get();
//        dd($file);
        foreach ($file as $row) {
            $n_empenho = substr($row->empenho, 0, 4) . "NE800" . substr($row->empenho, 3, 3);
            if ($row->cnpj == 0) {
                $cnpj = "00.000.000/0000-00";
            } else {
                $cnpj = substr($row->cnpj, 0, 2) . "." . substr($row->cnpj, 2, 3) . "." . substr($row->cnpj, 5, 3) . "/" . substr($row->cnpj, 8, 4) .
                        "-" . substr($row->cnpj, 12, 2);
            }

            $empenho = $this->empenhoRepository->index(['busca' => $n_empenho, 'paginate' => null])->first();
            if ($empenho == null) {
                $empenho = new Empenho();
                $fornecedor = $this->fornecedorRepository->index(['busca' => $cnpj, 'paginate' => null])->first();
                if ($fornecedor == null) {
                    $fornecedor = new Fornecedor();
                    $fornecedor->cnpj = $cnpj;
                    $fornecedor->email = strtolower(str_replace(' ', '', $row->r_social)) . "@email.com";
                    $fornecedor->razao = $row->r_social;
                    $fornecedor->fantasia = $row->r_social;
                    $fornecedor->status = 1;
                    $fornecedor->save();
                }
                $empenho->numero = $n_empenho;
                $empenho->tipo = "ORDINÁRIO";
                $empenho->cat_despesa = 0;
                $empenho->el_consumo = 30;
                $empenho->mod_licitacao = "Pregão";
                $empenho->num_processo = "00000000000/00-01";
                $empenho->fornecedor()->associate($fornecedor);
                $empenho->solicitante()->associate(Auth::user());
                $empenho->save();
            }
            $material = [];
            $material['codigo'] = [(int) $row->cod_barras];
            $material['descricao'] = [$row->descricao];
            $material['unidade_id'] = [3];
            $material['marca'] = [''];
            $material['sub_item_id'] = [(int) $row->sub_item];
            $material['vl_total'] = [number_format($row->vlr_real, 2, ',', '.')];
            $material['qtd_solicitada'] = [(int) $row->quat_total];
            $material['vencimento'] = [''];
            $material['qtd_min'] = ['0'];
            $material['imagem'] = [null];
            $subMateriais = $this->empenhoRepository->prepararSubMateriais($material, $empenho);
            if ($subMateriais) {
                $empenho->subMateriais()->saveMany($subMateriais);
            }
            $empenho->save();
        }
        foreach ($this->empenhoRepository->index() as $empenho) {
            $input = ['empenho' => $empenho->id,
                'entrada' => ['num_nf' => '000.000.000', 'natureza_op' => "Venda de Mercadoria",
                    'cod_chave' => '11111111111111111111111111111111111111111111',
                    'dt_emissao' => date('Y-m-d'), 'dt_recebimento' => date('Y-m-d')],
            ];
            $input['subMateriais']['qtds'] = [];
            foreach ($empenho->subMateriais as $subMaterial) {
                $input['subMateriais']['qtds'][$subMaterial->id] = $subMaterial->qtd_solicitada;
            }
            $entrada = $this->entradaRepository->store($input);
        }
        dd($this->entradaRepository->index());
        return;
    }

}
