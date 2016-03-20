<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CriarFornecedorRequest extends Request {

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
                    'fantasia' => 'required|min:5',
                    'razao' => 'required|min:5',
                    'endereco' => 'required|min:10',
                    'email' => 'required|email',
                    'cnpj' => 'required|min:14|unique:fornecedors',
                    'telefone1' => 'required|min:10',
                    'telefone2' => 'min:10'
		];
	}

}
