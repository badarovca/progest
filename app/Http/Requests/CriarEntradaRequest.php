<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CriarEntradaRequest extends Request {

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
                    'num_nf' => 'required',
                    'numero_empenho' => 'exists:empenhos,numero',
                    'cod_chave' => 'required|unique:entradas',
                    'natureza_op' => 'required',
                    'dt_emissao' => 'required|date',
                    'dt_recebimento' => 'required|date',
		];
                
//                foreach ($this->request->get('qtd') as $key => $val){
//                    $rules['qtd.'.$key] = 'required|numeric|min:0';
//                }
	}

}
