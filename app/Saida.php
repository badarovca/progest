<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saida extends Model {
    
    protected $fillable = [
        'obs'
    ];
    
    public function responsavel() {
        return $this->belongsTo('App\User', 'responsavel_id');
    }

    public function solicitante() {
        return $this->belongsTo('App\User', 'solicitante_id');
    }

    public function materiais() {
        return $this->belongsToMany('App\Material', 'saida_material')->withTimestamps()->withPivot('quant');
    }
    
    public function pedido(){
        return $this->belongsTo('App\Pedido');
    }

}
