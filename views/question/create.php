<?php
/**
 * @var array $questions
 * @var array $theme
 * @var array $themeList
 */

use lib\App;

?>

<h1>Задайте свой вопрос</h1>

<form action="<?= App::createUrl('question/askQuestion') ?>" method="POST">
    <input type="text" name="Data[author]" placeholder="Введите имя">
    <input type="email" name="Data[email]" placeholder="Введите email">
    <input type="text" name="Data[question]" placeholder="Введите ваш вопрос">

    <select name="Data[theme_id]" title="">
        <? foreach ($themeList as $id => $name) { ?>
            <option value="<?= $id ?>">
                <?= $name ?>
            </option>
        <? } ?>
    </select>

    <button type="submit">Отправить</button>
</form>

