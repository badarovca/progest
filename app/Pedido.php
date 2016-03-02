<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model {

    //
    protected $fillable = [
        'obs'
    ];

    public function solicitante() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function materiais() {
        return $this->belongsToMany('App\Material', 'pedido_material')->withTimestamps()->withPivot('quant');
    }

}
