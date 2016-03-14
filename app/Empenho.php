<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empenho extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empenhos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'numero', 'tipo', 'cat_despesa', 'el_consumo', 'mod_licitacao', 'num_processo', 'solicitantes','fornecedor_id'
    ];
    
    public function fornecedor(){
        return $this->belongsTo('App\Fornecedor');
    }
    
    public function solicitante(){
        return $this->belongsTo('App\User');
    }
    
    public function entradas(){
        return $this->hasMany('App\Entrada');
    }
    
    public function materiais() {
        return $this->belongsToMany('App\Material')->withTimestamps()->withPivot('quant', 'vl_total');
    }

}
