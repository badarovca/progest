<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordenacao extends Model {

    protected $fillable = [
        'name', 'coordenador', 'telefone', 'email', 'status'
    ];
    
    public function setores() {
        return $this->hasMany('App\Setor');
    }
}
