<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_nf', 'empenho_id', 'natureza_op', 'cod_chave', 'vl_total', 'dt_emissao', 'dt_recebimento', 'fornecedor_id'
    ];
    
    public function empenho(){
        return $this->belongsTo('App\Empenho');
    }
    
    public function materiais() {
        return $this->belongsToMany('App\Material')->withTimestamps()->withPivot('quant', 'vl_total');
    }

}
