<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Unidade as Unidade;

class UnidadeSeeder extends Seeder {

    public function run() {
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // clear table
        Unidade::truncate();
        
        Unidade::create([
           'name' => 'Caixa', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Dúzia', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Unidade', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Pacote', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Cento', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Resma', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Frasco', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Quilo', 'status' => true,
        ]);
        Unidade::create([
           'name' => 'Litro', 'status' => true,
        ]);
                
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
