<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Coordenacao as Coordenacao;

class CoordenacoesSeeder extends Seeder {

    public function run() {
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // clear table
        Coordenacao::truncate();
        
        Coordenacao::create([
           'name' => 'Pro tempore - Brumado', 'coordenador' => 'Acimarney Correia Silva Freitas', 'email' => 'acimarney@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'COPEX', 'coordenador' => 'Alberto dos Santos Rebouças', 'email' => 'albertoreb@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'Pregão', 'coordenador' => 'Alex Sousa Santos', 'email' => 'benysaac@yahoo.com.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CLIQUI', 'coordenador' => 'Anderson Marques de Oliveira', 'email' => 'cliqui.vdc@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'COTEP', 'coordenador' => 'Anely Silva Oliveira', 'email' => 'lyoliveira12@yahoo.com.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'NAPNE', 'coordenador' => 'Anely Silva Oliveira', 'email' => 'lyoliveira12@yahoo.com.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CVT', 'coordenador' => 'Bráulio Lima Mota', 'email' => 'bmota5@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CSI', 'coordenador' => 'Bruno Silvério Costa', 'email' => 'bsilverio@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CEAMB', 'coordenador' => 'Camila Daniele Willers', 'email' => 'camiladw@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'DEN', 'coordenador' => 'Camilo Alves Carvalho', 'email' => 'camilo.ifba@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'DAP – Brumado', 'coordenador' => 'Diógenes Moreira da Paz', 'email' => 'diodapaz@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'DIREH', 'coordenador' => 'Elisangela Ribeiro Cruz Maia', 'email' => 'elisrcruz@ifba.edu.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CAENS', 'coordenador' => 'Everard Lucas Silva Cardodo', 'email' => 'ifbalucas@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'DOF', 'coordenador' => 'Eziquiel Souza Santos', 'email' => 'eziquielss@ifba.edu.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CGTI', 'coordenador' => 'Igor Luiz Oliveira de Souza', 'email' => 'igorluizosouza@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CORES', 'coordenador' => 'Igor Meira Ribeiro', 'email' => 'igormeira@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'COTAM', 'coordenador' => 'Jackson Lino Paulo Santana de Miranda', 'email' => 'miranda.jacklino@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'Direção Geral', 'coordenador' => 'Jaime dos Santos Filho', 'email' => 'jaime@ifba.edu.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CEDIF', 'coordenador' => 'Joaz de Souza Batista', 'email' => 'joazbatista@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'COEEL', 'coordenador' => 'José Alberto Diaz Amado', 'email' => 'jose_diaz@ifba.edu.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'DIADS', 'coordenador' => 'José Alves Souza Filho', 'email' => 'josealvesfilho@bol.com.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CELET', 'coordenador' => 'José Dácio Alves Santos', 'email' => 'j.dacio@ig.com.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'DIMAP', 'coordenador' => 'José Olímpio Ribeiro Neto', 'email' => 'jorneto@ifba.edu.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'PROEJA', 'coordenador' => 'Josilene Domingues Santos Pereira', 'email' => 'josidomingues.ifba@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'COINFO', 'coordenador' => 'Luiz Fernando Cardeal de Souza', 'email' => 'fcardeal@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'DAP', 'coordenador' => 'Maribaldo Silva Ramos', 'email' => 'mariba@ifba.edu.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'SEPAT', 'coordenador' => 'Mark Rener dos Santos Teixeira', 'email' => 'markrener@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CTST', 'coordenador' => 'Maximiliano Coelho Machado', 'email' => 'max.maximiliano@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CDNC', 'coordenador' => 'Mônica Souza Moreira', 'email' => 'monymoreira@bol.com.br', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CENC', 'coordenador' => 'Orley Magalhães de Oliveira', 'email' => 'orley10estudo@yahoo.com.br ', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CCOMS', 'coordenador' => 'Renata de Sena Lacerda', 'email' => 'renatadesenalacerda@gmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'CELME', 'coordenador' => 'Silvana Garcia Viana', 'email' => 'vianaw@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
        Coordenacao::create([
           'name' => 'Gabinete', 'coordenador' => 'Valéria Melo Ferraz', 'email' => 'valeria_melo_mf@hotmail.com', 'telefone' => '(00) 0000-0000',
        ]);
                
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
