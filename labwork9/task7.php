<html>

<head>
    <meta charset="utf-8">
    <title>Задание 7 — фильтр книг</title>
    <style>
        .label {
            display: inline-block;
            width: 160px;
        }
    </style>
</head>

<body>
    <h1>Задание 7 — фильтр книг</h1>
    <p><a href="lab9.php">к лабораторной</a></p>
    <hr>

    <form method="get" action="task7_results.php">

        <p><span class="label">Название или автор (text)</span>
            <input type="text" name="query" placeholder="например, Толкин">
        </p>

        <p><span class="label">Жанр (select)</span>
            <select name="genre">
                <option value="">любой</option>
                <option value="фэнтези">фэнтези</option>
                <option value="фантастика">фантастика</option>
                <option value="детектив">детектив</option>
                <option value="классика">классика</option>
            </select>
        </p>

        <p><span class="label">Формат (radio)</span>
            <label><input type="radio" name="format" value="" checked> любой</label>
            <label><input type="radio" name="format" value="бумажная"> бумажная</label>
            <label><input type="radio" name="format" value="электронная"> электронная</label>
        </p>

        <p><span class="label">Язык (checkbox)</span>
            <label><input type="checkbox" name="lang[]" value="русский"> русский</label>
            <label><input type="checkbox" name="lang[]" value="английский"> английский</label>
            <label><input type="checkbox" name="lang[]" value="белорусский"> белорусский</label>
        </p>

        <p><span class="label">Изданы не раньше (number)</span>
            <input type="number" name="year_from" min="1800" max="2026" placeholder="год">
        </p>

        <button type="submit">Найти</button>
    </form>

</body>

</html>
