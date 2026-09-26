<html>

<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №5</title>
</head>

<body>
    <h1>Лабораторная работа №5</h1>
    <hr>

    <h2>Задание 1</h2>

    <?php
    echo "<pre>";

    # 1
    $str = "abcabcabc";
    echo "# 1: ", substr_count($str, "abc") . " " . substr_count($str, "abcabc"), "\n";

    # 2
    $str = "summer is the curse";
    echo "# 2: ", strpos($str, "s"), strpos($str, "t", 4), strpos($str, "e", -6), "\n";
    echo "     по отдельности: ";
    var_dump(strpos($str, "s"), strpos($str, "t", 4), strpos($str, "e", -6));

    # 3
    $str = "a light that never comes";
    echo "# 3: ", strpbrk($str, "fire"), strpbrk($str, "rose"), strpbrk($str, "sun"), "\n";
    echo "     по отдельности: ";
    var_dump(strpbrk($str, "fire"), strpbrk($str, "rose"), strpbrk($str, "sun"));

    echo "</pre>";
    ?>

    <h2>Задание 2</h2>

    <?php
    echo "<pre>";

    $str = "Она сказала: я люблю твоё золото, твои глаза и размах твоих крыльев";

    // содержится ли подстрока
    echo "твои:   ", var_export(str_contains($str, "твои"), true), "\n";
    echo "солнце: ", var_export(str_contains($str, "солнце"), true), "\n";
    echo "ТВОИ:   ", var_export(str_contains($str, "ТВОИ"), true), "\n";
    echo "раз:    ", var_export(str_contains($str, "раз"), true), "\n\n";

    // количество вхождений как подстроки (учитывает "твоих" и "размах")
    echo "как подстроки: "
        . mb_substr_count($str, "твои") . "-"
        . mb_substr_count($str, "солнце") . "-"
        . mb_substr_count($str, "ТВОИ") . "-"
        . mb_substr_count($str, "раз") . "\n";

    // количество вхождений как отдельных слов (\b — граница слова, u — UTF-8)
    echo "как слова:     "
        . preg_match_all('/\bтвои\b/u', $str) . "-"
        . preg_match_all('/\bсолнце\b/u', $str) . "-"
        . preg_match_all('/\bТВОИ\b/u', $str) . "-"
        . preg_match_all('/\bраз\b/u', $str) . "\n";

    echo "</pre>";
    ?>

    <h2>Задание 3</h2>

    <?php
    echo "<pre>";

    $str = "летний дождь стучит по крыше";
    echo "исходная строка: $str\n\n";

    // верхний регистр
    echo "верхний регистр:      ", mb_strtoupper($str), "\n";

    // первые буквы слов прописные
    echo "с заглавных букв:     ", mb_convert_case($str, MB_CASE_TITLE), "\n";

    // замена первого слова: всё до первого пробела меняем на новое слово
    echo "замена первого слова: ", "осенний" . substr($str, strpos($str, " ")), "\n";

    // удаление слова
    echo "удаление слова:       ", str_replace("стучит ", "", $str), "\n";

    // удаление пробелов в начале
    $spaced = "     " . $str;
    echo "до ltrim:             ";
    var_dump($spaced);
    echo "после ltrim:          ";
    var_dump(ltrim($spaced));

    // перемешивание символов: разбиваем на символы (mb_), перемешиваем, склеиваем
    $chars = mb_str_split($str);
    shuffle($chars);
    echo "перемешано (верно):   ", implode($chars), "\n";
    echo "str_shuffle (ломает кириллицу): ", str_shuffle($str), "\n";

    // коды 1-го, 4-го, 8-го и 11-го символов (нумерация с 0!)
    echo "\nкоды символов:\n";
    echo "1-й  '", mb_substr($str, 0, 1), "' = ", mb_ord(mb_substr($str, 0, 1)), "\n";
    echo "4-й  '", mb_substr($str, 3, 1), "' = ", mb_ord(mb_substr($str, 3, 1)), "\n";
    echo "8-й  '", mb_substr($str, 7, 1), "' = ", mb_ord(mb_substr($str, 7, 1)), "\n";
    echo "11-й '", mb_substr($str, 10, 1), "' = ", mb_ord(mb_substr($str, 10, 1)), "\n";

    echo "</pre>";
    ?>

    <h2>Задание 4</h2>

    <?php
    echo "<pre>";

    function isPalindrome(string $word): bool
    {
        $word = mb_strtolower($word);                           // регистр не важен
        $reversed = implode(array_reverse(mb_str_split($word))); // переворот по символам
        return $word === $reversed;
    }

    echo "дед:    ", var_export(isPalindrome("дед"), true), "\n";
    echo "шалаш:  ", var_export(isPalindrome("шалаш"), true), "\n";
    echo "топот:  ", var_export(isPalindrome("топот"), true), "\n";
    echo "абоба:  ", var_export(isPalindrome("абоба"), true), "\n";
    echo "Шалаш:  ", var_export(isPalindrome("Шалаш"), true), "\n";
    echo "привет: ", var_export(isPalindrome("привет"), true), "\n\n";

    echo "для сравнения strrev(\"дед\") = ", strrev("дед"), "  ← байты перевёрнуты, буквы сломаны\n";

    echo "</pre>";
    ?>

    <h2>Задание 5</h2>

    <?php
    echo "<pre>";

    # 1
    $a = "124406";
    $b = implode(":", str_split($a, 2));
    echo "# 1: $b\n";

    # 2 – имя файла
    $a = "www.domain.com/php/index.php";
    $b = substr(strrchr($a, "/"), 1);
    echo "# 2: $b\n";

    # 3 – имя пользователя
    $a = "my_name@domain.com";
    $b = strstr($a, "@", true);
    echo "# 3: $b\n";

    # 4
    $a = "12 / 1 * 2 + 4 : 65 < 96 | 11";
    $b = preg_replace('/\D+/', ' ', $a);                               // всё, что не цифры → один пробел
    $c = str_replace([' ', '/', '*', '+', ':', '<', '|'], '', $a);     // удалить все лишние символы
    echo "# 4: b = $b\n";
    echo "     c = $c\n";

    # 5
    $a = "2-1-1979";
    $b = vsprintf("%02d-%02d-%04d", explode("-", $a));
    echo "# 5: $b\n";

    # 6
    $a = "1234 5678";
    $b = implode(" ", array_reverse(explode(" ", strrev($a))));
    echo "# 6: $b\n";

    echo "</pre>";
    ?>

    <h2>Задание 6</h2>

    <?php
    echo "<pre>";

    for ($code = ord("a"); $code <= ord("z"); $code++) {
        echo chr($code);
    }
    echo "\n";

    echo "</pre>";
    ?>

    <h2>Задание 7</h2>

    <?php
    echo "<pre>";

    $letters = substr(str_shuffle(implode(range("a", "z"))), 0, 10);
    echo $letters, "\n";

    echo "</pre>";
    ?>

    <h2>Задание 8</h2>

    <?php
    echo "<pre>";

    $str = "<p><b>happy <i>end</i> tragedy</b></p>";

    $text = strip_tags($str);                  // "happy end tragedy"
    $pos = strrpos($text, " ");                // позиция последнего пробела
    $result = substr($text, 0, $pos + 1) . "<b>" . substr($text, $pos + 1) . "</b>";

    echo "без тегов:  ", $text, "\n";
    echo "результат:  ", $result, "\n";
    echo "HTML-код:   ", htmlspecialchars($result), "\n";

    echo "</pre>";
    ?>

</body>

</html>
