<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo', 'descricao', 'unidade', 'subitem_id', 'marca', 'qtd', 'vl_un', 'vl_total'
    ];

    public function subItem() {
        return $this->belongsTo('App\SubItem');
    }
    
    public function empenhos(){
        return $this->belongsToMany('App\Empenho')->withTimestamps();
    }

}
