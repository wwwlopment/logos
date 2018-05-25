<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../css/avtoriz.css" type="text/css">
    <title></title>
</head>

<body>
    <div class="login-box animated fadeInUp">
        <div class="box-header">
            <h2>Авторизуйтесь</h2>
        </div>

        <form method="post" action="/php/avtorization.php">
            <label for="username">Логін</label><br>
            <input autofocus type="text" name="username" placeholder="логін" id="username"><br>
            <label for="password">Пароль</label><br>
            <input type="password" name="password" placeholder="пароль" id="password"><br>
            <button type="submit">Увійти</button><br>
            <a href="#">
            <p class="small">Забули пароль?</p></a><br>
            <hr>
            <span class="result" style="color:#ff0000">
                <?php
              if (isset($result)) {
                echo ($result);
              }
                    ?>
            </span>
            <a href="../php/registr.php">
            <p class="small">Зареєструватись</p></a><br>
            <hr>
            <a href='../index.php'>На головну сторінку</a>
        </form>
    </div>
    
</body>
</html>
