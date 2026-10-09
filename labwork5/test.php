<?php

$str = "qqwertyuiopasdfghjklzxcvbnmqw";

$s1 = str_split($str, 4);

$s1[0] = strtoupper($s1[0]);

for ($i = 1; $i <= (strlen($str) / 4); $i++) {
    $s1[$i][0] = strtoupper($s1[$i][0]);
}

var_dump($s1);
