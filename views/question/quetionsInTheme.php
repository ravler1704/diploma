<?php
require_once __DIR__ . '/../../lib/database/DataBase.php';
$sthT = DataBase::selectQuestionName($_GET['id']);
$sthSelectThemes = DataBase::selectThemes('*', 'questions', 'theme_id', $_GET['id']);

?>


<? foreach ($sthT as $themeName) { ?>
<h1>Вопросы в теме "<? echo $themeName['name_themes'] ?>"</h1>
<? } ?>
<br />
<table border="1">
    <tr>
        <th>Вопрос</th>
        <th>Дата создания</th>
        <th>Ответ</th>
        <th>Добавить (изменить) ответ с публикацией или скрытием</th>
        <th>Статус</th>
        <th>Удаление вопроса</th>
        <th>Скрытие опубликованного вопроса</th>
        <th>Публикация скрытого вопроса</th>
        <th>Редактирование автора</th>
        <th>Редактирование текста вопроса</th>
        <th>Переместить в тему</th>
    </tr>
    <? foreach ($sthSelectThemes as $questionInTheme) { ?>
    <tr>
        <td><? echo $questionInTheme['question'] ?></td>
        <td><? echo $questionInTheme['date']; ?></td>
        <td><? echo $questionInTheme['answer']; ?></td>
        <td>
            <form action="/views/question/updateQuestion.php">
                <input type='hidden' name="table" formmethod="get" value="questions" />
                <input type='hidden' name="set" formmethod="get" value="answer" />
                <textarea placeholder="Введите текст ответа" name="setValue" title=""><? echo $questionInTheme['answer'] ?></textarea>
                <input type='hidden' name="idSuffix" formmethod="get" value="questions" />
                <input type='hidden' name="id" formmethod="get" value="<? echo $questionInTheme['id_questions'] ?>" />
                <button>Опубликовать ответ</button><br />
                <button>Сохранить и скрыть ответ</button>
            </form>

        </td>
        <td><? echo $questionInTheme['status']; ?></td>
        <td><a href="/views/question/echoDel.php?table=questions&idSuffix=questions&id=<? echo $questionInTheme['id_questions'] ?>">Удалить вопрос</a></td>
        <td><a href="">Скрыть вопрос</a></td>
        <td><a href="">Опубликовать вопрос</a></td>
        <td>
            <label>Автор:<? echo $questionInTheme['autor'] ?></label>
            <form action="/views/question/updateQuestion.php">
                <input type='hidden' name="table" formmethod="get" value="questions" />
                <input type='hidden' name="set" formmethod="get" value="autor" />
                <input name="setValue" placeholder="Введите нового автора"><br />
                <input type='hidden' name="idSuffix" formmethod="get" value="questions" />
                <input type='hidden' name="id" formmethod="get" value="<? echo $questionInTheme['id_questions'] ?>" />
                <button>Изменить автора</button>
            </form>
        </td>
        <td>
            <form action="/views/question/updateQuestion.php">
                <input type='hidden' name="table" formmethod="get" value="questions" />
                <input type='hidden' name="set" formmethod="get" value="question" />
                <textarea name="setValue" title=""><? echo $questionInTheme['question']; ?></textarea><br />
                <input type='hidden' name="idSuffix" formmethod="get" value="questions" />
                <input type='hidden' name="id" formmethod="get" value="<? echo $questionInTheme['id_questions'] ?>" />
                <button>Изменить вопрос</button>
            </form>
        </td>
        <td>
            <form action="/views/question/moveQuestion.php">
                <select title="">
                    <? $sthAllTheme = DataBase::select('*', 'themes'); ?>
                    <? foreach ($sthAllTheme as $allThemeName) { ?>
                    <option>
                        <? echo $allThemeName['name_themes']; ?>
                    </option>
                    <? } ?>
                </select>

                <button>Переместить</button>
            </form>
        </td>
    </tr>
    <? } ?>

</table>


<br />
<br />