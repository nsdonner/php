<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 28.04.2017
 * Time: 0:20
 */


/*
1. Объявить две целочисленные переменные $a и $b и задать им произвольные начальные
значения. Затем написать скрипт, который работает по следующему принципу:
a. если $a и $b положительные, вывести их разность;
b. если $а и $b отрицательные, вывести их произведение;
c. если $а и $b разных знаков, вывести их сумму;
ноль можно считать положительным числом.*/


$a = rand(-100, 100);
$b = rand(-100, 100);

echo "a=$a, b=$b <br>";

if ($a >= 0 && $b >= 0) {
    echo "Разница " . ($a - $b);
} elseif ($a < 0 && $b < 0) {
    echo "Произведение " . ($a * $b);
} else {
    echo "Сумма " . ($a + $b);
}


/*2. Присвоить переменной $а значение в промежутке [0..15]. С помощью оператора
switch организовать вывод чисел от $a до 15.*/


$a = rand(0, 15);

echo '<br>';

switch ($a) {

    case 0: {
        echo '0 <br>';
    }
    case 1: {
        echo '1 <br>';
    }
    case 2: {
        echo '2 <br>';
    }
    case 3: {
        echo '3 <br>';
    }
    case 4: {
        echo '4 <br>';
    }
    case 5: {
        echo '5 <br>';
    }
    case 6: {
        echo '6 <br>';
    }
    case 7: {
        echo '7 <br>';
    }
    case 8: {
        echo '8 <br>';
    }
    case 9: {
        echo '9 <br>';
    }
    case 10: {
        echo '10 <br>';
    }
    case 11: {
        echo '11 <br>';
    }
    case 12: {
        echo '12 <br>';
    }
    case 13: {
        echo '13 <br>';
    }
    case 14: {
        echo '14 <br>';
    }
    case 15: {
        echo '15 <br>';
    }
}

/*3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.
Обязательно использовать оператор return.*/


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
    return ($a / $b);
}

function mult($a, $b)
{
    return ($a * $b);
}

$a = rand(1, 100);
$b = rand(1, 100);

echo "a=$a, b=$b <br>";

/*4. Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation), где
$arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В зависимости от
переданного значения операции выполнить одну из арифметических операций (использовать
функции из пункта 3) и вернуть полученное значение (использовать switch).*/


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

echo mathOperation($a, $b, '+') . '<br>';
echo mathOperation($a, $b, '-') . '<br>';
echo mathOperation($a, $b, '/') . '<br>';
echo mathOperation($a, $b, '*') . '<br>';
/*
5. Посмотреть на встроенные функции PHP. Используя имеющийся HTML шаблон, вывести
текущий год в подвале при помощи встроенных функций PHP.*/


/*$date=date('Y'); уже реализовано в дз№1*/

/*6. *С помощью рекурсии организовать функцию возведения числа в степень. Формат: function
power($val, $pow), где $val – заданное число, $pow – степень.*/


function power($val, $pow)
{

    if ($pow == 1) return $val;

    if ($pow >= 2) {
        return $val * power($val, $pow - 1);
    }
    return 1;
}

echo power(2, 4) . '<br>';

/*7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с
правильными склонениями, например:
 22 часа 15 минут
 21 час 43 минуты*/
date_default_timezone_set('Etc/GMT-3');

function rudate()
{
    $hour = date('H');
    if ($hour == 1 || $hour == 21) $h = '';
    elseif (($hour > 1 && $hour < 5) || ($hour > 21 && $hour <= 24)) $h = 'а';
    elseif ($hour > 4 && $hour < 21) $h = 'ов';

    $min = date('i');
    if ($min == 1 || $min % 10 == 1) $m = 'а';
    elseif ($min == 2 || $min == 3 || $min == 4 || (($min % 10 == 2 || $min % 10 == 3 || $min % 10 == 4) && $min>20)) $m = 'ы';
    else $m = '';
    echo date('H' . ' час' . $h) . ' ' . date('i' . ' минут' . $m);
}

rudate();








