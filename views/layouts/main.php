<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="/assets/css/reset.css"> <!-- CSS reset -->
    <link rel="stylesheet" href="/assets/css/style.css"> <!-- Resource style -->
    <script src="/assets/js/modernizr.js"></script> <!-- Modernizr -->
    <title>FAQ</title>
</head>
<body>

<a href="index.php?r=question/create">Главная</a><br />
<a href="index.php?r=question/create">Задать вопрос</a><br />
<? if (!\lib\App::getUser()): ?>
<a href="index.php?r=auth/login">Войти как администратор</a><br />
<? else: ?>
<a href="index.php?r=question/index">Админ панель (пока тут)</a><br />
<a href="index.php?r=theme/index">Список тем</a><br />
<a href="index.php?r=auth/logout">Выйти</a><br /><br />
<? endif; ?>




<header>
    <h1>FAQ</h1>
</header>
    <?= $content ?>
<script src="/assets/js/jquery-2.1.1.js"></script>
<script src="/assets/js/jquery.mobile.custom.min.js"></script>
<script src="/assets/js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>