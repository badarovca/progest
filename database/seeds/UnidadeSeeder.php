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
           'name' => 'Caixa',
        ]);
        Unidade::create([
           'name' => 'Dúzia',
        ]);
        Unidade::create([
           'name' => 'Unidade',
        ]);
        Unidade::create([
           'name' => 'Pacote',
        ]);
        Unidade::create([
           'name' => 'Cento',
        ]);
        Unidade::create([
           'name' => 'Resma',
        ]);
        Unidade::create([
           'name' => 'Frasco',
        ]);
        Unidade::create([
           'name' => 'Quilo',
        ]);
        Unidade::create([
           'name' => 'Litro',
        ]);
                
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
