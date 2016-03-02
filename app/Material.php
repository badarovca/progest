<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'descricao', 'unidade', 'subitem_id', 'marca'
    ];

    public function subItem() {
        return $this->belongsTo('App\SubItem');
    }
    
    public function unidade() {
        return $this->belongsTo('App\Unidade');
    }
    
    public function empenhos(){
        return $this->belongsToMany('App\Empenho')->withTimestamps()->withPivot('quant', 'vl_total');
    }
    
    public function entradas(){
        return $this->belongsToMany('App\Entrada')->withTimestamps()->withPivot('quant', 'vl_total');
    }
    
    public function saidas(){
        return $this->belongsToMany('App\Saida', 'saida_material')->withTimestamps()->withPivot('quant');
    }
    
    public function pedidos(){
        return $this->belongsToMany('App\Pedido', 'pedido_material')->withTimestamps()->withPivot('quant');
    }

}
