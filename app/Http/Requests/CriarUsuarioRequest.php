<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CriarUsuarioRequest extends Request {

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
                    'name' => 'required|min:5',
                    'siape' => 'required|numeric|min:7',
                    'email' => 'required|email|unique:users',
                    'telefone' => 'min:10',
                    'setor_id' => 'required|exists:setors,id',
                    'role' => 'required|exists:roles,id'
		];
	}

}
