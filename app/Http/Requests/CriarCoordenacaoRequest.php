<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CriarCoordenacaoRequest extends Request {

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
                    'name' => 'required|min:3|unique:coordenacaos',
                    'coordenador' => 'required|min:5',
                    'telefone' => 'required|min:10',
                    'email' => 'required|email',
		];
	}

}
