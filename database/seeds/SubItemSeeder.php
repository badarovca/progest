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
        // clear table
        SubItem::truncate();
        
        SubItem::create([
            'material_consumo' => 'COMBUSTÍVEIS E LUBRIFICANTES AUTOMOTIVOS',
        ]);
        SubItem::create([
            'material_consumo' => 'COMBUSTÍVEIS E LUBRIFICANTES DE AVIAÇÃO',
        ]);
        SubItem::create([
            'material_consumo' => 'COMBUSTÍVEIS E LUBRIFICANTES PARA OUTRAS FINALIDADES',
        ]);
        SubItem::create([
            'material_consumo' => 'GÁS ENGARRAFADO',
        ]);
        SubItem::create([
            'material_consumo' => 'EXPLOSIVOS E MUNIÇÕES',
        ]);
        SubItem::create([
            'material_consumo' => 'ALIMENTOS PARA ANIMAIS',
        ]);
        SubItem::create([
            'material_consumo' => 'GÊNEROS DE ALIMENTAÇÃO',
        ]);
        SubItem::create([
            'material_consumo' => 'ANIMAIS PARA PESQUISA E ABATE',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL FARMACOLÓGICO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL ODONTOLÓGICO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL QUÍMICO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE COUDELARIA OU DE USO ZOOTÉCNICO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE CAÇA E PESCA',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL EDUCATIVO E ESPORTIVO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA FESTIVIDADES E HOMENAGENS',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE EXPEDIENTE',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE PROCESSAMENTO DE DADOS',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAIS E MEDICAMENTOS PARA USO VETERINÁRIO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE ACONDICIONAMENTO E EMBALAGEM',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE CAMA, MESA E BANHO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE COPA E COZINHA',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE LIMPEZA E PRODUÇÃO DE HIGIENIZAÇÃO',
        ]);
        SubItem::create([
            'material_consumo' => 'UNIFORMES, TECIDOS E AVIAMENTOS',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA MANUTENÇÃO DE BENS IMÓVEIS',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA MANUTENÇÃO DE BENS MÓVEIS (EXCETO VEÍCULOS)',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL ELÉTRICO E ELETRÔNICO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE MANOBRA E PATRULHAMENTO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE PROTEÇÃO E SEGURANÇA',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA ÁUDIO, VÍDEO E FOTO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA COMUNICAÇÕES',
        ]);
        SubItem::create([
            'material_consumo' => 'SEMENTES, MUDAS DE PLANTAS E INSUMOS',
        ]);
        SubItem::create([
            'material_consumo' => 'SUPRIMENTO DE AVIAÇÃO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA PRODUÇÃO INDUSTRIAL',
        ]);
        SubItem::create([
            'material_consumo' => 'SOBRESSALENTES, MÁQUINAS E MOTORES DE NAVIOS E EMBARCAÇÕES',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL LABORATORIAL',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL HOSPITALAR',
        ]);
        SubItem::create([
            'material_consumo' => 'SOBRESSALENTES DE ARMAMENTO',
        ]);
        SubItem::create([
            'material_consumo' => 'SUPRIMENTO DE PROTEÇÃO AO VÔO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA MANUTENÇÃO DE VEÍCULOS',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL BIOLÓGICO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA UTILIZAÇÃO EM GRÁFICA',
        ]);
        SubItem::create([
            'material_consumo' => 'FERRAMENTAS',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL PARA REABILITAÇÃO PROFISSIONAL',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE SINALIZAÇÃO VISUAL E AFINS',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL TÉCNICO PARA SELEÇÃO E TREINAMENTO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL BIBLIOGRÁFICO NÃO IMOBILIZÁVEL',
        ]);
        SubItem::create([
            'material_consumo' => 'AQUISIÇÃO DE SOFTWARES DE BASE',
        ]);
        SubItem::create([
            'material_consumo' => 'BENS MÓVEIS NÃO ATIVÁVEIS',
        ]);
        SubItem::create([
            'material_consumo' => 'BILHETES DE PASSAGEM',
        ]);
        SubItem::create([
            'material_consumo' => 'BANDEIRAS, FLÂMULAS E INSÍGNIAS',
        ]);
        SubItem::create([
            'material_consumo' => 'DISCOTECAS E FILMOTECAS NAO IMOBILIZAVEL',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL DE CARATER SECRETO OU RESERVADO',
        ]);
        SubItem::create([
            'material_consumo' => 'MATERIAL METEOROLOGICO',
        ]);
    }

}
