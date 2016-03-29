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

    public function subMateriais() {
        return $this->belongsToMany('App\SubMaterial', 'saida_sub_material')->withTimestamps()->withPivot('quant');
    }
    
    public function pedido(){
        return $this->belongsTo('App\Pedido');
    }

}
