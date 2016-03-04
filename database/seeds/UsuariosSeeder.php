<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\User;

class UsuariosSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // clear table
        User::truncate();
        User::create([
           'name' => 'Administrador',
           'email' => 'administrador@progest.com',
           'password' => bcrypt('administrador1'),
           'telefone' => '(77) 98888-8888',
           'siape' => '1111111',
           'habilitado' => 1,
        ])->attachRole(Role::find(1));
        
        User::create([
           'name' => 'Solicitante',
           'email' => 'solicitante@progest.com',
           'password' => bcrypt('solicitante1'),
           'telefone' => '(77) 99199-9991',
           'siape' => '2222222',
           'habilitado' => 1,
        ])->attachRole(Role::find(2));
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
