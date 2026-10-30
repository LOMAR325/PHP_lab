<?php

echo "<pre>";

function func1(): int
{
    return func_num_args();
}

echo func1(1, 2, 4);

$a = "func1";

echo $a(5,6);

$email = "23423@";

$add_local_part = function (string $name) use (&$email): void {
    $email .= $name;
};

$add_local_part("student");
echo "<br>";
echo $email;


$dec = function (string $name) use (&$email) : void {
    $email .= "test";
};

$dec("");
echo "<br>";
echo $email;
echo "<br>";

function add_at(): void
{
    global $email;
    $email .= "@";
}

add_at();
echo "<br>";
echo $email;
echo "<br>";


$ad= [1,5,7,10];

function gen(array $ad) : Generator {
    foreach($ad as $elem) {
        yield $elem;
    }
}

$s1 = gen($ad);

foreach($s1 as $elements){
    echo "<br>";
    echo $elements;
}
