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
                    'solicitante_id' => 'required|exists:users,id'
		];
	}

}
