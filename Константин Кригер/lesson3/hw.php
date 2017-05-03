<?php
/**
 * Created by PhpStorm.
 * User: Donner
 * Date: 30.04.2017
 * Time: 18:33
 */

/*1. С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без остатка.*/

$i = 0;

while ($i <= 100) {

    if ($i % 3 == 0) echo $i . '<br>';
    $i++;
}

/*2. С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат выглядел так:

0 – это ноль.
1 – нечетное число.
2 – четное число.
3 – нечетное число.
…
10 – четное число.*/

$i = 0;

do {
    if ($i == 0) echo $i . ' - это ноль <br>';
    elseif ($i % 2 == 0) echo $i . ' - четное число <br>';
    else echo $i . ' - нечетное число <br>';

    $i++;
} while ($i <= 10);


/*3. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в качестве значений – массивы с названиями городов из соответствующей области. Вывести в цикле значения массива, чтобы результат был таким:

Московская область:
Москва, Зеленоград, Клин
Ленинградская область:
Санкт-Петербург, Всеволожск, Павловск, Кронштадт
Рязанская область … (названия городов можно найти на maps.yandex.ru)*/

$aMap = array("Московская область" => array("Москва", "Зеленоград", "Клин"),
    "Ленинградская область" => array("Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"),
    "Тюменская область" => array("Тюмень", "Ключи", "Сургут", "Нефтеюганск", "Когалым"));
foreach ($aMap as $key => $value) {
    echo $key . ":<br>";
    foreach ($aMap[$key] as $town) {
        echo $town . " ";
    }
    echo "<br>";
}
echo "<br>";

/*4. Объявить массив, индексами которого являются буквы русского языка, а значениями –
 соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).

Написать функцию транслитерации строк.*/
function translit($s)
{
    $alfa = array('а' => 'a', 'А' => 'A', 'б' => 'b', 'Б' => 'B', 'в' => 'v', 'В' => 'V', 'г' => 'g', 'Г' => 'G', 'д' => 'd', 'Д' => 'D', 'е' => 'e', 'Е' => 'E', 'ё' => 'e',
        'Ё' => 'E', 'ж' => 'j', 'Ж' => 'J', 'з' => 'z', 'З' => 'Z', 'и' => 'i', 'И' => 'I', 'й' => 'i', 'Й' => 'I', 'к' => 'k', 'К' => 'K', 'л' => 'l', 'Л' => 'L',
        'м' => 'm', 'М' => 'M', 'н' => 'n', 'Н' => 'N', 'о' => 'o', 'О' => 'O', 'п' => 'p', 'П' => 'P', 'р' => 'r', 'Р' => 'R', 'с' => 's', 'С' => 'S', 'т' => 't',
        'Т' => 'T', 'у' => 'u', 'У' => 'U', 'ф' => 'f', 'Ф' => 'F', 'х' => 'h', 'Х' => 'H', 'ц' => 'c', 'Ц' => 'C', 'ч' => 'ch', 'Ч' => 'Ch', 'ш' => 'sh', 'Ш' => 'Sh',
        'щ' => 'sh\'', 'Щ' => 'Sh\'', 'ъ' => '', 'Ъ' => '', 'ы' => 'i', 'Ы' => 'I', 'ь' => '\'', 'Ь' => '\'', 'э' => 'e', 'Э' => 'E', 'ю' => 'yu', 'Ю' => 'Yu', 'я' => 'ya', 'Я' => 'Ya');
    /*$ar = str_split($s, 2);
    foreach ($ar as $key => $value) {*/
    foreach ($alfa as $key => $value) {
        $s = str_replace($key, $value, $s);
    }
    return $s;
}


echo translit('Гамарджоба, Генацвали!');
echo "<br>";

/*5. Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку.*/

function space($s)
{
    return str_replace(" ", "_", $s);
}

echo space('текст с пробелами<br>');

/*6. В имеющемся шаблоне сайта заменить статичное меню (ul - li) на генерируемое через PHP.
Необходимо представить пункты меню как элементы массива и вывести их циклом. Подумать, как можно реализовать меню с вложенными подменю? Попробовать его реализовать.*/
/*смотреть index.php   вложенное меню прекрасно реализуется средствами js и css,
 с помощью php можно точно так же сгенерить структуру, прикрутить многомерные массивы, css скроет подменю,
 js покажет по событию, реализовывать лень т.к. выходит за рамки курса,
 да и я скорее всего слишком глобально понял задание*/


/*7. *Вывести с помощью цикла for числа от 0 до 9, НЕ используя тело цикла. То есть выглядеть должно так:

for (…){ // здесь пусто}*/


for ($i = 0; $i <= 9; print $i++) {

}

echo "<br>";
echo "<br>";
/*8. *Повторить третье задание, но вывести на экран только города, начинающиеся с буквы «К».*/
/*!!! Нужен рабочий mbstring !!!*/


$aMap = array("Московская область" => array("Москва", "Зеленоград", "Клин"),
    "Ленинградская область" => array("Санкт-Петербург", "Всеволожск", "Павловск", "Кронштадт"),
    "Тюменская область" => array("Тюмень", "Ключи", "Сургут", "Нефтеюганск", "Когалым"));

foreach ($aMap as $key => $value) {
    echo $key . "<br>";
    foreach ($value as $town) {
        if (mb_substr($town, 0, 1, 'utf-8') == 'К') echo $town . ' ';
    }
    echo "<br>";
}
echo "<br>";


/*9. *Объединить две ранее написанные функции в одну, которая получает строку на русском языке,
 производит транслитерацию и замену пробелов на подчеркивания (аналогичная задача решается при
 конструировании url-адресов на основе названия статьи в блогах).*/

function transspace($string)
{
    return translit(space($string));
}

echo transspace('Какой то текст на русском языке с пробелами.');







