<?php

namespace App\progest\repositories;
use Intervention\Image\ImageManagerStatic as Image;

class ImagemRepository {

    public function sendImage($img, $path, $thumbs = array()) {
        try {

            $nomeUnico = md5(uniqid(time()));
            $imagem = Image::make($img);
            $caminhoImagem = $path . $nomeUnico . '.jpg';

            $imagem->save(public_path($caminhoImagem));

            if (count($thumbs > 0)) {
                foreach ($thumbs as $val) {
                    $thumb = Image::make($img);;
                    $thumb->fit($val['width'], $val['height']);
                    $caminhoThumb = $path . $nomeUnico . "_" . $val['width'] . "x" . $val['height'] . '.jpg';
                    $thumb->save(public_path($caminhoThumb));
                }
            }
            return $caminhoImagem;
        } catch (Exception $t) {
            return $t;
        }
    }

}
