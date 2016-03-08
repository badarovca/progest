<?php

namespace App\progest\repositories;

use App\User;
use App\Setor;
use App\Coordenacao;
use App\Role;

class UsuarioRepository {

    public function dataForSelect() {
        $baseArray = User::where('habilitado', 1)->get();
        $usuarios = array();
        $usuarios[''] = 'Selecione...';
        foreach ($baseArray as $value) {
            $usuarios[$value->id] = $value->name." - ".$value->setor->coordenacao->name;
        }
        return $usuarios;
    }
    
    public function getRolesForSelect(){
        $baseArray = Role::all();
        $roles = array();
        $roles[] = 'Selecione...';
        foreach ($baseArray as $value) {
            $roles[$value->id] = $value->display_name;
        }
        return $roles;
    }

    public function index() {
        return User::all();
    }

    public function store($input) {
        $user = new User();
        $user->name = $input['name'];
        $user->siape = $input['siape'];
        $user->email = $input['email'];
        $user->telefone = $input['telefone'];
        $user->habilitado = isset($input['habilitado']) ? 1 : 0;

        $setor = Setor::find($input['setor_id']);
        $user->setor()->associate($setor);

        $user->save();
        $user->roles()->attach($input['role']);
        return $user;
    }

    public function update($id, $input) {
        $user = User::find($id);
        $user->name = $input['name'];
        $user->siape = $input['siape'];
        $user->email = $input['email'];
        $user->telefone = $input['telefone'];
        $user->habilitado = isset($input['habilitado']) ? 1 : 0;

        $setor = Setor::find($input['setor_id']);
        $user->setor()->associate($setor);
        
        $user->save();
        if($user->roles()->first()->id != $input['role']){
            $user->roles()->sync([$input['role']]);
        }
        return $user;
    }

    public function show($id) {
        return User::findOrFail($id);
    }

    public function destroy($id) {
        $user = User::find($id);
        return $user->delete();
    }

//    public function getRolesForSelect(){
//        $baseArray = Role::all();
//        $roles = array();
//        foreach ($baseArray as $value) {
//            $roles[$value->id] = ucfirst($value->name);
//        }
//        return $roles;
//    }
}
