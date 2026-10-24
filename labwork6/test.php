<?php

$a = [4,2,8,12,9,1];

array_reverse($a);

sort($a);

$b = array_filter($a,fn($s) => $s%2 == 0);

print_r($b);