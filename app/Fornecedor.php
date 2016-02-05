<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    public function empenhos(){
        return $this->hasMany('App\Empenho');
    }
}
