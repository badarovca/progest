<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model {

    protected $fillable = [
        'name'
    ];

    public function materiais() {
        return $this->hasMany('App\Material');
    }

}
