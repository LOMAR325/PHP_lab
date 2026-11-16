<?php
//Вариант 1
echo "<pre>";
//Задание 1
function counter()
{
    static $count = 0;
    return ++$count;
}
counter();
counter();
echo counter();

echo "<br>";

$total = 10;
function addTax(&$sum)
{
    $sum *= 1.2;
}
addTax($total);
echo $total;

//Задание 2

$n = rand(3,8);
$m = rand(3, 8);
$a = [];
$max=-1e9;
$sum  = 0;

echo "<br>";

for($i=0;$i<$n;$i++){
    for ($j = 0; $j < $m; $j++) {
        $a[$i][$j] = rand(1,9);
        $sum +=$a[$i][$j];
    }    
    if($sum>$max)
    {
        $max=$sum;
        $s1=$i;
    }
    $sum=0;
}
$b = $a;
$c = $b[0];
$b[0]=$b[$s1];
$b[$s1]=$c;

echo "<br>";

echo "строка с максимальной суммой ",$s1;
echo "<br>";

print_r($a);

echo "<br>","это разделение";
print_r($b);

