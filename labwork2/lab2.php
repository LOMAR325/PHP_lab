<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №2</title>
</head>

<body>
    <h1>Лабораторная работа №2</h1>
    <hr>

    <h2>Задание 1</h2>

    <?php
    # 1
    $a = 24;
    $a7 = $a + 2;
    echo $a7;

    echo "<br><br>";

    # 2
    $a = 2;
    $b = 42;
    echo $a + $b;

    echo "<br><br>";

    # 3
    $клюква = "клюква";
    $малина = "малина";
    echo $клюква . $малина;

    echo "<br><br>";

    # 4
    $_ = "бебебе";
    $__ = "бябябя";
    echo $_ . $__;
    ?>

    <h2>Задание 2</h2>

    <?php
    $bool = true;   // boolean
    $int  = 7;      // integer
    $str  = "4";    // string

    echo "bool + int  = " . ($bool + $int) . "<br>";        // 8
    echo "int  - bool = " . ($int - $bool) . "<br>";        // 6
    echo "int  * str  = " . ($int * $str) . "<br>";         // 28
    echo "int  / str  = " . ($int / $str) . "<br>";         // 1.75
    echo "bool . int . str = " . ($bool . $int . $str);     // 174
    ?>

    <h2>Задание 3</h2>

    <?php

    echo "<p># 1</p>";

    $a = 4000000000000000000000;
    var_dump($a);
    echo "<br><br>";
    $a **= $a;
    var_dump($a);

    echo "<br><br>";

    echo "<p># 2</p>";

    $b = "ляляля";
    $b = (string)(bool)(int)$b;
    var_dump((int)$b);
    echo "<br>";
    var_dump((bool)(int)$b);
    echo "<br>";
    var_dump($b);

    echo "<br><br>";

    echo "<p># 3</p>";

    $a = true;
    $b = false;
    $c = (bool)($d = "чечевица") + $a * $b;
    var_dump($c);

    echo "<br><br>";

    echo "<p># 4</p>";

    $a = 40 + 0b111 + 0o4 + 0xA;
    var_dump($a);
    ?>

    <h2>Задание 4</h2>

    <?php
    # 4
    $numbers = [7, 42, 255, 1024, 2024];

    echo "<table border='1' cellpadding='6'>";
    echo "<tr>";
    echo "<td>Исходное число</td>";
    echo "<td>Двоичный вид</td>";
    echo "<td>Восьмеричный вид</td>";
    echo "<td>Шестнадцатиричный вид</td>";
    echo "</tr>";

    foreach ($numbers as $n) {
        echo "<tr>";
        echo "<td>" . $n . "</td>";
        echo "<td>" . decbin($n) . "</td>";
        echo "<td>" . base_convert($n, 10, 8) . "</td>";
        echo "<td>" . sprintf("%X", $n) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

    <h2>Задание 5</h2>

    <?php
    # 5
    $values = [4_345.27, "12парара", true, null, "\n800\n", INF];

    foreach ($values as $v) {
        echo "<p>исходное: ";
        var_dump($v);
        echo "(int)   → ";
        var_dump((int)$v);
        echo "(float) → ";
        var_dump((float)$v);
        echo "(bool)  → ";
        var_dump((bool)$v);
        echo "</p>";
    }
    ?>

    <h2>Задание 6</h2>

    <?php
    $s1 = 'одинарные кавычки';
    $s2 = "двойные кавычки";
    $s3 = <<<TXT
        heredoc
        TXT;
    $s4 = <<<'TXT'
        nowdoc
        TXT;

    echo "<pre>";
    var_dump($s1, $s2, $s3, $s4);

    $a = "мир";
    $b = "!";

    $s1 = '$a$b';
    $s2 = "$a$b";
    $s3 = 'строка $a, конец';
    $s4 = "строка $a, конец";
    $s5 = <<<TXT
        heredoc: $a$b
        TXT;
    $s6 = <<<'TXT'
        nowdoc: $a$b
        TXT;

    var_dump($s1, $s2, $s3, $s4, $s5, $s6);
    echo "</pre>";
    ?>

    <h2>Задание 7</h2>

    <?php
    $a1 = [10, 20, 30];              
    $a2 = array("a", "b", "c");      
    $a3 = range(1, 5);               
    $a4 = [];
    $a4[] = "x";                     
    $a4[] = "y";

    // индексный массив с ключами для некоторых элементов
    $a5 = [0 => "ноль", "два" => 2, 5 => "пять", "авто"];

    // ассоциативный массив
    $a6 = ["name" => "Влад", "age" => 20, "group" => "10ТВ"];

    // массив с целочисленными и строковыми ключами
    $a7 = [1 => "один", "b" => "бэ", 3 => "три", "d" => "дэ"];

    // многомерный массив
    $a8 = [
        "фрукты"  => ["яблоко", "груша"],
        "матрица" => [[1, 2], [3, 4]],
    ];

    echo "<pre>";
    var_dump($a1, $a2, $a3, $a4, $a5, $a6, $a7, $a8);

    // полная деструктуризация
    ["name" => $name, "age" => $age, "group" => $group] = $a6;  
    [[$m11, $m12], [$m21, $m22]] = $a8["матрица"];              

    var_dump($name, $age, $group, $m11, $m12, $m21, $m22);
    echo "</pre>";
    ?>

    <h2>Задание 8</h2>

    <?php
    echo "<pre>";

    $v1 = [1 => 'aaa', 2 => 'bbb', 'ccc', 8 => 'ddd', 'eee'];
    var_dump($v1);                       
    echo "$v1[1] $v1[2] $v1[3] $v1[8] $v1[9]\n\n";

    $v2 = ['ржится' => 'рожь', 'овёс овсится', 'чечевица' => 'чечевится', 'вот так'];
    var_dump($v2);                       
    echo "{$v2['ржится']} $v2[0] {$v2['чечевица']} $v2[1]\n\n";

    $v3 = [1 => 'один', true => 'один?', "1" => 'один??', -1 => 'не один...'];
    var_dump($v3);                      
    echo "$v3[1] {$v3[-1]}\n\n";         

    $v4 = ['массив' => ['массив' => ['массив' => ['не массив']]]];
    var_dump($v4);
    echo $v4['массив']['массив']['массив'][0] . "\n";

    echo "</pre>";
    ?>

    <h2>Задание 9</h2>

    <?php
    // объект через объявление класса
    class Point
    {
        public int $x = 10;
        public int $y = 20;

        public function sum(): int
        {
            return $this->x + $this->y;
        }
    }

    $p = new Point();

    echo "<pre>";
    var_dump($p);                       
    echo "sum = " . $p->sum() . "\n\n";

    var_dump((object)42);               
    var_dump((object)"привет");
    var_dump((object)true);
    echo "\n";

    $assoc = (object)['name' => 'Влад', 'age' => 20];
    var_dump($assoc);                   
    echo $assoc->name . "\n\n";

    $indexed = (object)[1, 2, 3];
    var_dump($indexed);                 
    echo $indexed->{'0'} . "\n";

    echo "</pre>";
    ?>

</body>

</html>