<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditarUsuarioRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $except = '';
        $except = ($this->get('id')!=null) ? ',email,'.$this->get('id') : '';
        return [
            'name' => 'required|min:5',
            'siape' => 'required|numeric|min:7',
            'email' => 'required|email|unique:users'.$except,
            'telefone' => 'min:10',
            'setor_id' => 'required|exists:setors,id',
            'password' => 'confirmed',
            'role' => 'required|exists:roles,id'
        ];
    }

}
