<h1>Таблица администраторов</h1><br />
<h2>Добавить администратора</h2>
<form action="<?= App::createUrl('user/addAdmin') ?>" method="POST">
    <input type='text' name="Data[name]" placeholder="Введите имя"/>
    <input type='text' name="Data[password]" placeholder="Введите пароль"/>
    <button type="submit">Добавить</button>
</form><br />
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
                <form action="<?= App::createUrl('user/updatePassword') ?>" method="POST">
                    <input type='text' name="Data[password]" placeholder="Введите новый пароль" />
                    <input type='hidden' name="Data[id]" value="<? echo $value['id']; ?>" />
                    <button type="submit">Изменить</button>
                </form>

            </td>
            <td><a href="<?= App::createUrl('user/delete', ['id' => $value['id']]) ?>">Удалить администратора</a></td>
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
