<?php

//Задание 1

//Задание 2
echo "<pre>";

$str  = "asfuioqdf";
$n = strlen($str) + rand(3, 10);

$new_str = str_split($str);

$pad = implode(array_pad($new_str, $n, "@"));

$codes = $pad;

$codes[2] = chr(rand(65, 122));
$codes[4] = chr(rand(65, 122));
$codes[7] = chr(rand(65, 122));

$m = strlen($str) - strlen(strpbrk($str, "dvrk"));

$parts[0] = substr($str, 0, $m);
$parts[1] = substr($str, $m);


unset($str, $n, $new_str, $pad, $codes, $m, $parts);

//Задание 3

for ($i = 0; $i < 30; $i++) {
    $str[$i] = rand(5, 9);
}


$str = implode("", $str);
$arr = chunk_split($str, 5, " ");
$str_n = $arr;
$arr = explode(" ", $str_n);
array_pop($arr);

$shuffle = shuffle($arr);
$cut[0] = $arr[1];
$cut[1] = $arr[2];
$cut[2] = $arr[3];
$cut[3] = $arr[4];

$delete = $cut;
array_shift($delete);
array_pop($delete);

$prod = $delete[0] * $delete[1];

$diff = array_diff($cut, $delete);

unset($arr);
echo "<br>";

//Задание 4

$arr = [
    2 => "два",
    4 => "четыре",
    3 => "три",
    1 => "один",
    5 => "пять"
];

krsort($arr);

$arr = array_flip($arr);

$keys = array_keys($arr);
$values = array_values($arr);

shuffle($keys);
shuffle($values);

$t = array_combine($keys, $values);

$t["четыре"] = "шесть";
print_r($t);


//Задание 5

$arr = [
    'image1.jpg' => [[0, 30, 200], [45, 82, 250], [67, 89, 254]],
    'image2.jpg' => [[0, 50, 230], [42, 82, 253], [69, 82, 230]],
    'image3.jpg' => [[0, 40, 240], [46, 82, 254], [64, 81, 223]],
];
$size = 3;

function find(array $a){
    if(is_array($a))
        {
            find($a);
        }
        else{
            $s = min($a);
        }
    return $s;
};


print_r(min($arr));