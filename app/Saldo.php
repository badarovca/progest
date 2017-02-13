<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Saldo extends Model {
    
    use PresentableTrait;

    protected $presenter = 'App\progest\presenters\SaldoPresenter';

    protected $fillable = [
        'vl_entrada', 'vl_saida', 'mes', 'ano', 'sub_item_id', 'valor',
    ];

    public function subItem() {
        return $this->belongsTo('App\SubItem');
    }

}
