<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\SubItem as SubItem;

class SubItemSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // clear table
        SubItem::truncate();
        
        SubItem::create([
            'material_consumo' => 'COMBUSTÍVEIS E LUBRIFICANTES AUTOMOTIVOS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'COMBUSTÍVEIS E LUBRIFICANTES DE AVIAÇÃO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'COMBUSTÍVEIS E LUBRIFICANTES PARA OUTRAS FINALIDADES', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'GÁS ENGARRAFADO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'EXPLOSIVOS E MUNIÇÕES', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'ALIMENTOS PARA ANIMAIS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'GÊNEROS DE ALIMENTAÇÃO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'ANIMAIS PARA PESQUISA E ABATE', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL FARMACOLÓGICO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL ODONTOLÓGICO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL QUÍMICO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE COUDELARIA OU DE USO ZOOTÉCNICO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE CAÇA E PESCA', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL EDUCATIVO E ESPORTIVO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA FESTIVIDADES E HOMENAGENS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE EXPEDIENTE', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE PROCESSAMENTO DE DADOS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAIS E MEDICAMENTOS PARA USO VETERINÁRIO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE ACONDICIONAMENTO E EMBALAGEM', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE CAMA, MESA E BANHO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE COPA E COZINHA', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE LIMPEZA E PRODUÇÃO DE HIGIENIZAÇÃO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'UNIFORMES, TECIDOS E AVIAMENTOS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA MANUTENÇÃO DE BENS IMÓVEIS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA MANUTENÇÃO DE BENS MÓVEIS (EXCETO VEÍCULOS)', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL ELÉTRICO E ELETRÔNICO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE MANOBRA E PATRULHAMENTO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE PROTEÇÃO E SEGURANÇA', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA ÁUDIO, VÍDEO E FOTO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA COMUNICAÇÕES', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'SEMENTES, MUDAS DE PLANTAS E INSUMOS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'SUPRIMENTO DE AVIAÇÃO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA PRODUÇÃO INDUSTRIAL', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'SOBRESSALENTES, MÁQUINAS E MOTORES DE NAVIOS E EMBARCAÇÕES', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL LABORATORIAL', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL HOSPITALAR', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'SOBRESSALENTES DE ARMAMENTO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'SUPRIMENTO DE PROTEÇÃO AO VÔO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA MANUTENÇÃO DE VEÍCULOS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL BIOLÓGICO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA UTILIZAÇÃO EM GRÁFICA', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'FERRAMENTAS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA REABILITAÇÃO PROFISSIONAL', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE SINALIZAÇÃO VISUAL E AFINS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL TÉCNICO PARA SELEÇÃO E TREINAMENTO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL BIBLIOGRÁFICO NÃO IMOBILIZÁVEL', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'AQUISIÇÃO DE SOFTWARES DE BASE', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'BENS MÓVEIS NÃO ATIVÁVEIS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'BILHETES DE PASSAGEM', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'BANDEIRAS, FLÂMULAS E INSÍGNIAS', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'DISCOTECAS E FILMOTECAS NAO IMOBILIZAVEL', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE CARATER SECRETO OU RESERVADO', 'status' => true,
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL METEOROLOGICO', 'status' => true,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

}
