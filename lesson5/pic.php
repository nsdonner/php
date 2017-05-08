<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 08.05.2017
 * Time: 22:52
 */


if (isset($_GET['pic'])) {

    $link = mysqli_connect("localhost", "root", "", "gallery");
        $result = mysqli_query($link,"SELECT * FROM pics WHERE id > 0");
//можно было выбрать конкретную строку, но уже лень переделывать.
    $epms = array();
    while($row = mysqli_fetch_assoc($result))
        $epms[] = $row;


    $i=0;

    foreach ($epms as $id => $value){
        if ($epms[$id]['id'] == $_GET['pic']){
            $count = $epms[$id]['clicks']+1;
            $s = $epms[$id]['path'];
            $result = mysqli_query($link,("UPDATE `pics` SET `clicks` = '").($count).("' WHERE `pics`.`id` = ").$value['id']);
            }
        $i++;
    }



    $html = '

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<img src="'.$s.'" alt=""><br>'.
$count.'

</body>
</html>






';
    echo $html;

} else {
    echo "Something wrong";
    exit;
}

