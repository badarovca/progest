<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMaterial extends Model {

    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vencimento', 'quant',
    ];
    
    public function material() {
        return $this->belongsTo('App\Material');
    }
    
    public function empenhos() {
        return $this->belongsToMany('App\Empenho', 'empenho_sub_material')->withTimestamps()->withPivot('quant', 'vl_total');
    }

    public function entradas() {
        return $this->belongsToMany('App\Entrada', 'entrada_sub_material')->withTimestamps()->withPivot('quant', 'vl_total');
    }

    public function saidas() {
        return $this->belongsToMany('App\Saida', 'saida_sub_material')->withTimestamps()->withPivot('quant');
    }

}
