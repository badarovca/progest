<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class FilterMaterialRequest extends Request {

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
			'order' => 'in:updated_at-desc,updated_at-asc,descricao-asc,descricao-desc,qtd_1-asc,qtd_1-desc,sub_item_id-asc',
		];
	}

}
