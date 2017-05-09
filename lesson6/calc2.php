<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 09.05.2017
 * Time: 2:58
 */


if (isset($_GET['a'])) {

    function summ($a, $b)
    {
        return ($a + $b);
    }

    function sub($a, $b)
    {
        return ($a - $b);
    }

    function div($a, $b)
    {
        if ($b != 0) return ($a / $b); else return 'Деление на ноль';
    }

    function mult($a, $b)
    {
        return ($a * $b);
    }



    function mathOperation($a, $b, $operation)
    {
        switch ($operation) {
            case '*':
                return mult($a, $b);
            case '/':
                return div($a, $b);
            case '+':
                return summ($a, $b);
            case '-':
                return sub($a, $b);
            default:
                return ('nope');

        }

    }

    echo mathOperation($_GET['a'],$_GET['b'],$_GET['oper']);


} else {


    $html = '
        
        <!DOCTYPE html>
            <html lang="en">
                <head>
                    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
                    <title>Document</title>
                    <link rel="stylesheet" href="style.css">
                </head>
                <body>
                    <form action="" method="get">
                    
                    
                    <input type="number" value="1" name="a" id="">
                     
                     <input type="submit" name="oper" value="+">
                     <input type="submit" name="oper" value="-">
                     <input type="submit" name="oper" value="*">
                     <input type="submit" name="oper" value="/">
                     
                     
                    <input type="number" value="1" name="b" id=""> 
                    
         
                    
                    </form>
                </body>
            </html>
  
    
    ';


    echo $html;

}

