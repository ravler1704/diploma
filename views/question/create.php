<?php
use lib\App;
?>

<h1>Задайте свой вопрос</h1>

<form action="<?= App::createUrl('question/askQuestion') ?>" method="POST">
    <input type="text" name="Data[author]" placeholder="Введите имя">
    <input type="email" name="Data[email]" placeholder="Введите email">
    <input type="text" name="Data[question]" placeholder="Введите ваш вопрос">

    <button type="submit">Отправить</button>
</form>

