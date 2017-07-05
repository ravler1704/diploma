<?php
use lib\App;

/**
 * @var array $errors
 */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
<h1>Вход в админ панель</h1>
<ul>
    <? foreach ($errors as $error): ?>
        <li><?= $error; ?></li>
    <? endforeach; ?>
</ul>

<form action="<?= App::createUrl('auth/login') ?>" method="POST">
    <input name="Data[name]" placeholder="Введите логин">
    <input name="Data[password]" placeholder="Введите пароль">
    <button type="submit">Войти</button>
</form>
<br/>
<br/>
<br/>
</html>




