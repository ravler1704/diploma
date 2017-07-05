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
        <th>Скрытие/публикация вопроса</th>
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
            <form action="<?= App::createUrl('question/updateAnswer') ?>" method="POST">
                <!--<input type='hidden' name="table" formmethod="get" value="questions" />-->
                <!--<input type='hidden' name="set" formmethod="get" value="answer" />-->
                <textarea name="Data[answer]" placeholder="Введите текст ответа"><? echo $questionInTheme['answer'] ?></textarea>
                <input type='hidden' name="Data[theme_id]" value="<? echo $questionInTheme['theme_id'] ?>" />
                <input type='hidden' name="Data[id]" value="<? echo $questionInTheme['id'] ?>" />
                <button type="submit" name="Data[publishButton]">Опубликовать ответ</button><br />
                <button type="submit" name="Data[saveButton]">Сохранить и скрыть ответ</button>
            </form>


        </td>
        <td><? echo $questionInTheme['status']; ?></td>
        <td><a href="<?= App::createUrl('question/deleteQuestionInTheme', ['id' => $questionInTheme['id'], 'theme_id' => $questionInTheme['theme_id']]) ?>">Удалить вопрос</a></td>
        <td><a href="<?= App::createUrl('question/updateStatus', ['Data[id]' => $questionInTheme['id'], 'Data[theme_id]' => $questionInTheme['theme_id'], 'Data[status]' => $questionInTheme['status']]) ?>">Скрыть/опубликовать</a></td>
        <td>
            <label>Автор:<? echo $questionInTheme['author'] ?></label>
            <form action="<?= App::createUrl('question/updateAuthor', ['id' => App::getParam('id')]) ?>" method="post">
                <input name="Data[author]" placeholder="Введите нового автора"><br />
                <input type='hidden' name="Data[id]" value="<? echo $questionInTheme['id'] ?>" />
                <button>Изменить автора</button>
            </form>
        </td>
        <td>

            <form action="<?= App::createUrl('question/updateInTheme') ?>" method="POST">
                <textarea name="Data[question]" title=""><? echo $questionInTheme['question']; ?></textarea><br />
                <input type='hidden' name="Data[id]" value="<?= $questionInTheme['id'] ?>" />
                <input type='hidden' name="Data[theme_id]" value="<? echo $questionInTheme['theme_id'] ?>" />
                <button type="submit">Изменить вопрос</button>
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