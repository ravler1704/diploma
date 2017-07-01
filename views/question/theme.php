<?php
/**
 * @var array $questions
 * @var array $theme
 * @var array $themeList
 */

use lib\App;

?>

<h1>Вопросы в теме "<?= $theme['name'] ?>"</h1>
<br />
<table class="table-bordered">
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
    <? foreach ($questions as $questionInTheme) { ?>
    <tr>
        <td><? echo $questionInTheme['question'] ?></td>
        <td><? echo $questionInTheme['date']; ?></td>
        <td><? echo $questionInTheme['answer']; ?></td>
        <td>
            <form action="/del/updateQuestion.php">
                <input type='hidden' name="table" formmethod="get" value="questions" />
                <input type='hidden' name="set" formmethod="get" value="answer" />
                <textarea placeholder="Введите текст ответа" name="setValue" title=""><? echo $questionInTheme['answer'] ?></textarea>
                <input type='hidden' name="idSuffix" formmethod="get" value="questions" />
                <input type='hidden' name="id" formmethod="get" value="<? echo $questionInTheme['id'] ?>" />
                <button>Опубликовать ответ</button><br />
                <button>Сохранить и скрыть ответ</button>
            </form>

        </td>
        <td><? echo $questionInTheme['status']; ?></td>
        <td><a href="/del/echoDel.php?table=questions&idSuffix=questions&id=<? echo $questionInTheme['id'] ?>">Удалить вопрос</a></td>
        <td><a href="">Скрыть вопрос</a></td>
        <td><a href="">Опубликовать вопрос</a></td>
        <td>
            <label>Автор:<? echo $questionInTheme['author'] ?></label>
            <form action="<?= App::createUrl('question/updateAuthor', ['id' => App::getParam('id')]) ?>" method="post">
                <input name="Data[author]" placeholder="Введите нового автора"><br />
                <input type='hidden' name="Data[id]" value="<? echo $questionInTheme['id'] ?>" />
                <button>Изменить автора</button>
            </form>
        </td>
        <td>
            <form action="/del/updateQuestion.php">
                <input type='hidden' name="table" formmethod="get" value="questions" />
                <input type='hidden' name="set" formmethod="get" value="question" />
                <textarea name="setValue" title=""><? echo $questionInTheme['question']; ?></textarea><br />
                <input type='hidden' name="idSuffix" formmethod="get" value="questions" />
                <input type='hidden' name="id" formmethod="get" value="<? echo $questionInTheme['id'] ?>" />
                <button>Изменить вопрос</button>
            </form>
        </td>
        <td>
            <form action="<?= App::createUrl('question/move', ['id' => App::getParam('id')]) ?>" method="post">
                <input type="hidden" name="Data[id]"  value="<?= $questionInTheme['id'] ?>">
                <select name="Data[theme_id]">
                    <? foreach ($themeList as $id => $name) { ?>
                    <option value="<?= $id ?>">
                        <?= $name ?>
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