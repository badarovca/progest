<?php
namespace App\progest\presenters;

use Laracasts\Presenter\Presenter;

class BasePresenter extends Presenter {

    public function created_at($data) {
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function last_update() {
        return date('d/m/Y H:i', strtotime($this->updated_at));
    }
    
    public function formatDate($date){
        return date('d/m/Y', strtotime($date));
    }
    
    public function formatDateTime($date){
        return date('d/m/Y H:i', strtotime($date));
    }
    
    public function formatReal($valor){
        return number_format($valor, 2, ',', '.');
    }

    public function getThumbUrl($caminho, $width, $height) {
        $ext = strchr($caminho, '.');
        $nome_img = explode(".", $caminho);
        $caminho = $nome_img[0];
        $url = $caminho . '_' . $width . 'x' . $height . $ext;

        return $url;
    }
    
}
