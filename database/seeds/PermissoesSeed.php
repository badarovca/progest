<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class PermissoesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // clear table
        Role::truncate();
        Role::create([
           'name' => 'admin',
           'display_name' => 'Administrador',
        ]);
        Role::create([
           'name' => 'solicitante',
           'display_name' => 'Solicitante',
        ]);
        Role::create([
           'name' => 'almoxarife',
           'display_name' => 'Almoxarife',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
