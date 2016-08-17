<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Material extends Model {
    
     use PresentableTrait;
     
    protected $presenter = 'App\progest\presenters\MaterialPresenter';

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
        'codigo', 'descricao', 'unidade', 'subitem_id', 'marca', 'qtd_min', 'imagem'
    ];

    public function unidade() {
        return $this->belongsTo('App\Unidade');
    }
    
    public function subMateriais() {
        return $this->hasMany('App\SubMaterial');
    }
    
    public function pedidos(){
        return $this->belongsToMany('App\Pedido', 'pedido_material')->withTimestamps()->withPivot('quant');
    }

}
