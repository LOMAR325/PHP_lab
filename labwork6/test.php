<?php
echo "<pre>";
$color = [
    ["name" => "Vasia", "age" => 14]
];

print_r($color);

$n = [1, 3, 4, 4, 6, 7];

print_r(array_unique($n));

print_r(array_pad($n, 8, 0));

$random = fn() => substr(str_shuffle(str_repeat("qwertyuiopasdfghjklzxcvbnm",5)),0,rand(1,10));

echo $random();

