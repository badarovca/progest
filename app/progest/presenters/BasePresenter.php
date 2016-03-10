<?php
namespace App\progest\presenters;

use Laracasts\Presenter\Presenter;

class BasePresenter extends Presenter {

    public function formatDate($data) {
        return date('d/m/Y', strtotime($data));
    }

    public function formatDateTime($data) {
        return date('d/m/Y H:i', strtotime($data));
    }

    public function getThumbUrl($caminho, $width, $height) {
        $ext = strchr($caminho, '.');
        $nome_img = explode(".", $caminho);
        $caminho = $nome_img[0];
        $url = $caminho . '_' . $width . 'x' . $height . $ext;

        return $url;
    }
    
}
