<!--/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 03.05.2017
 * Time: 1:21
 */
-->


<?php
$link = mysqli_connect("localhost", "root", "", "gallery");
$result = mysqli_query($link,"SELECT * FROM pics WHERE id > 0 ORDER BY `clicks` DESC");

$epms = array();
while($row = mysqli_fetch_assoc($result))
    $epms[] = $row;



class SimpleImage
{

    var $image;
    var $image_type;

    function load($filename)
    {
        $image_info = getimagesize($filename);
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null)
    {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    function output($image_type = IMAGETYPE_JPEG)
    {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image);
        }
    }

    function getWidth()
    {
        return imagesx($this->image);
    }

    function getHeight()
    {
        return imagesy($this->image);
    }

    function resizeToHeight($height)
    {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width)
    {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale)
    {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }
}

function shrink($src, $ssrc, $h, $w)
{
    $image = new SimpleImage();
    $image->load($src);
    $image->resize($h, $w);
    $image->save($ssrc);
}


$gallery = '';
$i=0;

foreach ($epms as $id => $value){
    $picsrc=$epms[$id]["path"];
    $spicsrc=$epms[$id]["spath"];
    $gallery .= '<li><a href="pic.php?pic='.$epms[$id]["id"].'"target="_blank"><img src="'. $spicsrc .'" alt=""></a></li>';
    $i++;
    }


/*while (file_exists('img/sgood' . $i . '.jpg')) {
    $gallery .= '<li><a href="img/good' . $i . '.jpg"' . 'target="_blank"><img src="img/sgood' . $i . '.jpg" alt=""></a></li>';
    $i++;
}*/


if ($_FILES) {
    if (!($_FILES['file']['type'] == 'image/jpeg')) {
        echo 'Допустимы только jpeg файлы';

    } else {
        if (move_uploaded_file($_FILES['file']['tmp_name'], 'img/good'.($i+1).'.jpg')) {

            shrink('img/good' . ($i+1) . '.jpg', 'img/sgood' . ($i+1) . '.jpg', 200, 200);
            $result = mysqli_query($link,"INSERT INTO `pics` (`id`, `path`, `spath`, `clicks`) VALUES (NULL, 'img/good".($i+1).".jpg', 'img/sgood".($i+1).".jpg', '0')");
            unset($_POST);
            header("Location: hw.php");

        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="gal">

    <ul class="galul">
        <?= $gallery ?>
    </ul>


</div>

<br>
<form action="hw.php" enctype="multipart/form-data" method="post">

    <input type="file" name="file">
    <input type="submit">


</form>


</body>
</html>