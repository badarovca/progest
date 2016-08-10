<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model {

    protected $fillable = [
        'vl_entrada', 'vl_saida', 'mes', 'ano', 'sub_item_id', 'valor',
    ];

    public function subItem() {
        return $this->belongsTo('App\SubItem');
    }

}
