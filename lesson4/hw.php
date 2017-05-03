<!--/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 03.05.2017
 * Time: 1:21
 */
-->


<?php


class SimpleImage {

    var $image;
    var $image_type;

    function load($filename) {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if( $this->image_type == IMAGETYPE_JPEG ) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif( $this->image_type == IMAGETYPE_GIF ) {
            $this->image = imagecreatefromgif($filename);
        } elseif( $this->image_type == IMAGETYPE_PNG ) {
            $this->image = imagecreatefrompng($filename);
        }
    }
    function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image,$filename,$compression);
        } elseif( $image_type == IMAGETYPE_GIF ) {
            imagegif($this->image,$filename);
        } elseif( $image_type == IMAGETYPE_PNG ) {
            imagepng($this->image,$filename);
        }
        if( $permissions != null) {
            chmod($filename,$permissions);
        }
    }
    function output($image_type=IMAGETYPE_JPEG) {
        if( $image_type == IMAGETYPE_JPEG ) {
            imagejpeg($this->image);
        } elseif( $image_type == IMAGETYPE_GIF ) {
            imagegif($this->image);
        } elseif( $image_type == IMAGETYPE_PNG ) {
            imagepng($this->image);
        }
    }
    function getWidth() {
        return imagesx($this->image);
    }
    function getHeight() {
        return imagesy($this->image);
    }
    function resizeToHeight($height) {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width,$height);
    }
    function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width,$height);
    }
    function scale($scale) {
        $width = $this->getWidth() * $scale/100;
        $height = $this->getheight() * $scale/100;
        $this->resize($width,$height);
    }
    function resize($width,$height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
}

function shrink($src,$h,$w){
    $image = new SimpleImage();
    $image->load($src);
    $image->resize($h, $w);
    $image->save('s'.$src);
}


/*$filename = '/path/to/foo.txt';

if (file_exists($filename)) {
    echo "Файл $filename существует";
} else {
    echo "Файл $filename не существует";
}*/



$gallery = '';

$i = 1;



while (file_exists('img/sgood'.$i.'.jpg')){

        $gallery.='<li><a href="img\sgood'.$i.'.jpg"'.'target="_blank"><img src="img/good'.$i.'.jpg" alt=""></a></li>';
    $i++;
}





?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="gal">

    <ul class="galul">
        <!--<li><a href="img/good1.jpg" target="_blank"><img src="img/good1.jpg" alt=""></a></li>
        <li><a href="img/good2.jpg" target="_blank"><img src="img/good2.jpg" alt=""></a></li>
        <li><a href="img/good3.jpg" target="_blank"><img src="img/good3.jpg" alt=""></a></li>
        <li><a href="img/good4.jpg" target="_blank"><img src="img/good4.jpg" alt=""></a></li>-->

        <?=$gallery?>

    </ul>
    
    
    
</div>



</body>
</html>