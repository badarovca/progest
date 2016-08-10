<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Devolucao extends Model {

    use PresentableTrait;

    protected $presenter = 'App\progest\presenters\DevolucaoPresenter';

    //
    public function subMateriais() {
        return $this->belongsToMany('App\SubMaterial')->withTimestamps()->withPivot('quant');
    }

    public function saida() {
        return $this->belongsTo('App\Saida');
    }

}
