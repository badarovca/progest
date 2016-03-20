<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CriarMaterialRequest extends Request {

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
