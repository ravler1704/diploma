<?
use lib\App;
?>

<h1>Таблица администраторов</h1>

<table class="table-bordered">
    <tr>
        <th>Имя администратора</th>
        <th>Смена пароля</th>
        <th>Удаление</th>
    </tr>
    <? foreach ($users as $value) { ?>
        <tr>
            <td><?= $value['name']; ?></td>
            <td>
                <form action="/del/updatePassword.php">
                    <input name="newPassword" formmethod="get" placeholder="Введите новый пароль" />
                    <input type='hidden' name="userId" formmethod="get" value="<? echo $value['id']; ?>" />
                    <button>Изменить</button>

                </form>
            </td>
            <td><a href="/del/echoDel.php?table=users&idSuffix=users&id=<? echo $value['id'] ?>">Удалить администратора</a></td>
        </tr>
    <? } ?>
</table>

<br />
<br />


<br />
<br />


<h1>Вопросы без ответа в порядке добавления</h1>

<br />
<table class="table-bordered">
    <tr>
        <th>Вопрос</th>
        <th>Новая редакция вопроса</th>
        <th>Дата добавления вопроса</th>
        <th>Удаление вопроса</th>

    </tr>
    <? foreach ($questions as $value) { ?>
        <tr>
            <td><? echo $value['question']; ?></td>
            <td>
                <form action="<?= App::createUrl('question/update') ?>" method="POST">
                    <textarea name="Data[question]" title=""><? echo $value['question']; ?></textarea><br />
                    <input type='hidden' name="Data[id]" value="<? echo $value['id'] ?>" />
                    <button type="submit">Изменить вопрос</button>
                </form>
            </td>
            <td><? echo $value['date']; ?></td>
            <td><a href="<?= App::createUrl('question/delete', ['id' => $value['id']]) ?>">Удалить вопрос</a></td>
        </tr>
    <? } ?>
</table>
