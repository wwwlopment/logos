<?php
if (session_id() == '') {
    session_start();
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
        "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>Мій сайт</title>
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Gabriela" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/animate.css" type="text/css">
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div id="logo">
            Мій сайт
        </div>

        <div id="language">
            <ul>
                <li><a href="#">ua</a></li>

                <li><a href="#">en</a></li>
            </ul>
        </div>
    </div>

    <div id="menubar">
        <div id="menu">
            <ul>
                <li><a href="#">Новини</a></li>
                <li><a href="#">Гостьова книга</a></li>
                <li><a href="#">Контакти</a></li>
                <li><a href="http://logos.loc/php/phpinfo.php">phpinfo</a></li>
                <?php
                if (isset($_SESSION['policyes']) && ($_SESSION['policyes'] == "admin")) {
                    echo(
                    "<li><a href=\"http://logos.loc/php/adminka.php\">Адмінпанель</a></li>"
                    );
                }
                ?>
                <li><a href="http://logos.loc/adminer-4.3.1-mysql.php" target="_blank">Адмінер</a></li>
            </ul>
        </div>

        <div id="avtorization">
            <ul>
                <?php
                if (empty($_SESSION['login'])) {
                    echo "<li><a href=\"index.php?auth\">Увійти</a></li>
        <li> / </li>
        <li><a href=\"/php/registr.php\">Реєстрація</a></li>";
                    //   include "php/avtorization.php";
                } else {
                    echo("<li><a href=\"index.php?exit=1\"> Вийти </a></li>
        <li><a href=\"#\">Ви зайшли як <span class=\"userhead\">" . $_SESSION['login'] . "   ---  ");
                    if (!empty($_SESSION['login'])) {
                        echo('Ваш IP :' . $_SERVER["REMOTE_ADDR"] . "</br>");
                        include $_SERVER['DOCUMENT_ROOT'] . "/php/location.php";
                        if (detect_city($_SERVER["REMOTE_ADDR"]) != 'UNKNOWN') {
                            echo('Ви зайшли з ' . detect_city($_SERVER["REMOTE_ADDR"]) . "</span></a></li>");
                        }
                    }
                }
                error_reporting(E_ALL);
                include $_SERVER['DOCUMENT_ROOT'] . "/php/avtorization.php";
                ?>
            </ul>
        </div>
    </div>
    <div id="content">


        <div id="news">
            Каждый веб-разработчик знает, что такое текст-«рыба». Текст этот, несмотря на название, не имеет никакого
            отношения к обитателям водоемов. Используется он веб-дизайнерами для вставки на интернет-страницы и
            демонстрации внешнего вида контента, просмотра шрифтов, абзацев, отступов и т.д. Так как цель применения
            такого текста исключительно демонстрационная, то и смысловую нагрузку ему нести совсем необязательно. Более
            того, нечитабельность текста сыграет на руку при оценке качества восприятия макета. Самым известным «рыбным»
            текстом является знаменитый Lorem ipsum. Считается, что впервые его применили в книгопечатании еще в XVI
            веке. Своим появлением Lorem ipsum обязан древнеримскому философу Цицерону, ведь именно из его трактата «О
            пределах добра и зла» средневековый книгопечатник вырвал отдельные фразы и слова, получив текст-«рыбу»,
            широко используемый и по сей день. Конечно, возникают некоторые вопросы, связанные с использованием Lorem
            ipsum на сайтах и проектах,
            ориентированных на кириллический контент – написание символов на латыни и на кириллице значительно
            различается. И даже с языками, использующими латинский алфавит, могут возникнуть небольшие проблемы: в
            различных языках те или иные буквы встречаются с разной частотой, имеется разница в длине наиболее
            распространенных слов. Отсюда напрашивается вывод, что все же лучше использовать в качестве «рыбы» текст на
            том языке, который планируется использовать при запуске проекта. Сегодня существует несколько вариантов
            Lorem ipsum, кроме того, есть специальные генераторы, создающие собственные варианты текста на основе
            оригинального трактата, благодаря чему появляется возможность получить более длинный неповторяющийся набор
            слов.
        </div>


    </div>
    <div id="footer">
        -= 2017 =-
    </div>


</div>

</body>
</html>