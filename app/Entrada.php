<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Entrada extends Model {

    use PresentableTrait;

    protected $presenter = 'App\progest\presenters\EntradaPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'num_nf', 'empenho_id', 'natureza_op', 'cod_chave', 'vl_total', 'dt_emissao', 'dt_recebimento', 'fornecedor_id'
    ];

    public function empenho() {
        return $this->belongsTo('App\Empenho');
    }

    public function subMateriais() {
        return $this->belongsToMany('App\SubMaterial')->withTimestamps()->withPivot('quant', 'vl_total');
    }
    
}
