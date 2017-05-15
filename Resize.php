<?php


class Resize {
    public $filename;
    public $newFilename;
    public $width;
    public $height;
    
    function __construct($filename, $newFilename, $width, $height) {
        $this->filename = $filename;
        $this->newFilename = $newFilename;
        $this->width = $width;
        $this->height = $height;
    }

    public function resizeJpg(){
        // O arquivo. Dependendo da configuração do PHP pode ser uma URL.
   
        //$filename = 'http://exemplo.com/original.jpg';

        // Largura e altura máximos (máximo, pois como é proporcional, o resultado varia)
        // No caso da pergunta, basta usar $_GET['width'] e $_GET['height'], ou só
        // $_GET['width'] e adaptar a fórmula de proporção abaixo.
        $width = $this->width;
        $height = $this->height;

        // Obtendo o tamanho original
        list($width_orig, $height_orig) = getimagesize($this->filename);

        // Calculando a proporção
        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        // O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefromjpeg($this->filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        /*Gerando a imagem de saída para ver no browser, qualidade 90%:
        header('Content-Type: image/jpeg');
        imagejpeg($image_p, null, 90);*/

        // Ou, se preferir, Salvando a imagem em arquivo:
        imagejpeg($image_p, $this->newFilename, 90);
    }
    public function resizePng(){
        // O arquivo. Dependendo da configuração do PHP pode ser uma URL.
   
        //$filename = 'http://exemplo.com/original.jpg';

        // Largura e altura máximos (máximo, pois como é proporcional, o resultado varia)
        // No caso da pergunta, basta usar $_GET['width'] e $_GET['height'], ou só
        // $_GET['width'] e adaptar a fórmula de proporção abaixo.
        $width = $this->width;
        $height = $this->height;

        // Obtendo o tamanho original
        list($width_orig, $height_orig) = getimagesize($this->filename);

        // Calculando a proporção
        $ratio_orig = $width_orig / $height_orig;

        if ($width / $height > $ratio_orig) {
            $width = $height * $ratio_orig;
        } else {
            $height = $width / $ratio_orig;
        }

        // O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefrompng($this->filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

        /*Gerando a imagem de saída para ver no browser, qualidade 90%:
        header('Content-Type: image/jpeg');
        imagejpeg($image_p, null, 90);*/

        // Ou, se preferir, Salvando a imagem em arquivo:
        imagepng($image_p, $this->newFilename, 9);
    }
}
