<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 26.04.2017
 * Time: 8:07
 */


    $a = 5;
    $b = '05';
    var_dump($a == $b);         // Почему true?
    var_dump((int)'012345');     // Почему 12345?
    var_dump((float)123.0 === (int)123.0); // Почему false?
    var_dump((int)0 === (int)'hello, world'); // Почему true?
