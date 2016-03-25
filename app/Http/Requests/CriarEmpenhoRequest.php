<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CriarEmpenhoRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
                    'numero' => 'required|unique:empenhos|min:12',
                    'tipo' => 'required',
                    'fornecedor_id' => 'required|exists:fornecedors,id',
                    'cat_despesa' => 'required|numeric',
                    'el_consumo' => 'required',
                    'mod_licitacao' => 'required',
                    'num_processo' => 'required',
                    'solicitante_id' => 'required|exists:users,id',
                    'codigo' => 'required|numeric|unique:materials|min:10',
                    'descricao' => 'required|min:10',
                    'unidade_id' => 'required|exists:unidades,id',
                    'marca' => 'required',
                    'sub_item_id' => 'required|exists:sub_items,id',
                    'vencimento' => 'date',
                    'imagem' => 'image',
                    'qtd_1' => 'numeric|min:0|required',
                    'qtd_min' => 'numeric|min:0|required'
		];
	}

}
