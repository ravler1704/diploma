<?php
use lib\App;
?>
<h1>Список тем</h1>
<form action="/del/createTheme.php">
    <label>Создание новой темы:</label>
    <input name="themeName" placeholder="Введите название темы">
    <input type='hidden' name="idSuffix" formmethod="get" value="themes" />
    <button>Создать</button>
</form>
<br />
<table class="table-bordered">
    <tr>
        <th>Название темы</th>
        <th>Вопросы в теме</th>
        <th>Всего вопросов в теме</th>
        <th>Опубликованно вопросов</th>
        <th>Вопросов без ответа</th>
        <th>Удаление темы</th>
    </tr>
    <? foreach ($themes as $value) { ?>
        <tr>
            <td><? echo $value['name']; ?></td>
            <td><a href="<?= App::createUrl('question/theme', ['id' => $value['id']]) ?>">Вопросы в этой теме</a></td>
            <td><? echo $value['questions_all']; ?></td>
            <td><? echo $value['questions_published']; ?></td>
            <td><? echo $value['questions_unanswerd']; ?></td>
            <td><a href="<?= App::createUrl('theme/delete', ['id' => $value['id']]) ?>">Удалить тему</a></td>
        </tr>
    <? } ?>
</table>