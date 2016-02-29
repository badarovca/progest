<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model {

    public function users() {
        return $this->hasMany('App\User');
    }
    
    public function coordenacao() {
        return $this->belongsTo('App\Coordenacao');
    }

}
