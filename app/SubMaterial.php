<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class SubMaterial extends Model {

    use PresentableTrait;

    protected $presenter = 'App\progest\presenters\SubMaterialPresenter';
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vencimento', 'qtd_estoque', 'vl_total', 'qtd_solicitada', 'material_id'
    ];

    public function material() {
        return $this->belongsTo('App\Material');
    }

    public function empenho() {
        return $this->belongsTo('App\Empenho');
    }

    public function entradas() {
        return $this->belongsToMany('App\Entrada', 'entrada_sub_material')->withTimestamps()->withPivot('quant', 'vl_total');
    }

    public function saidas() {
        return $this->belongsToMany('App\Saida', 'saida_sub_material')->withTimestamps()->withPivot('quant');
    }

}
