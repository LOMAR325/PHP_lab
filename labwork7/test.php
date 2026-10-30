<?php

echo "<pre>";

$a = [3, 5, 2, 8, 2, 9, 12, 456, 234];
$s1 = 0;
$i = 0;

print_r($a);


foreach ($a as $mem[]) {
    if ($mem[$i] > 6 and $mem[$i] < 400) {
        $s1++;
    }
    $i++;
}
$i=0;
switch ($s1):
    case 1:
        echo "<p>Один раз не считается</p>";
        break;
    case 2:
        echo "<p>Два тоже не считается</p>";
        break;
    case 3:
        echo "<p>Бог любит троицу</p>";
        break;
    case 4:
        echo "<p>ОУ ЕЕЕЕ, ты чертовски попал, их $s1</p>";
        break;
endswitch;
