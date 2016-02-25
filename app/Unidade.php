<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model {

    protected $fillable = [
        'name'
    ];

    public function usuarios() {
        return $this->hasMany('App\User');
    }

}
