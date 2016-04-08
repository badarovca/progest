<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubItem extends Model {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sub_items';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'material_consumo', 'status'
    ];
    
    public function materiais() {
        return $this->hasMany('App\Material');
    }
}
