<?php

namespace App\progest\repositories;

use App\Fornecedor;

class FornecedorRepository {

    public function dataForSelect() {
        $baseArray = Fornecedor::all();
        $fornecedores = array();
        $fornecedores[] = 'Selecione...';
        foreach ($baseArray as $value) {
            $fornecedores[$value->id] = $value->razao;
        }
        return $fornecedores;
    }

    public function index() {
        return Fornecedor::all();
    }

    public function store($input) {
        $fornecedor = new Fornecedor();
        $fornecedor->fantasia = $input['fantasia'];
        $fornecedor->razao = $input['razao'];
        $fornecedor->endereco = $input['endereco'];
        $fornecedor->email = $input['email'];
        $fornecedor->cnpj = $input['cnpj'];
        $fornecedor->telefone1 = $input['telefone1'];
        $fornecedor->telefone2 = $input['telefone2'];
        $fornecedor->save();
    }

    public function update($id, $input) {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->fantasia = $input['fantasia'];
        $fornecedor->razao = $input['razao'];
        $fornecedor->endereco = $input['endereco'];
        $fornecedor->email = $input['email'];
        $fornecedor->cnpj = $input['cnpj'];
        $fornecedor->telefone1 = $input['telefone1'];
        $fornecedor->telefone2 = $input['telefone2'];
        return $fornecedor->save();
    }

    public function show($id) {
        return Fornecedor::findOrFail($id);
    }

    public function destroy($id) {
        $fornecedor = Fornecedor::find($id);
        $fornecedor->desativado = 1;
        return $fornecedor->save();
//return $fornecedor->delete();
    }

}
