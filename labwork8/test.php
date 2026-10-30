<?php

$a = [1,5,3,7,10];

function gen(array $a) : Generator {
    foreach($a as $elem){
        yield $elem *=2;
    }
}

foreach(gen($a) as $elem) {
    echo "<br>";
    echo $elem;
}