<?
require_once App::getRoot() . "models/Questions.php";
$questions = new Questions();
$items = $questions->select();
?>

<h1>Таблица администраторов</h1>

<table border="1">
    <tr>
        <th>Имя администратора</th>
        <th>Смена пароля</th>
        <th>Удаление</th>
    </tr>
    <? foreach ($items as $value) { ?>
        <tr>
            <td><?= $value['name_users']; ?></td>
            <td>
                <form action="/del/updatePassword.php">
                    <input name="newPassword" formmethod="get" placeholder="Введите новый пароль" />
                    <input type='hidden' name="userId" formmethod="get" value="<? echo $value['id_users']; ?>" />
                    <button>Изменить</button>

                </form>
            </td>
            <td><a href="/del/echoDel.php?table=users&idSuffix=users&id=<? echo $value['id_users'] ?>">Удалить администратора</a></td>
        </tr>
    <? } ?>
</table>

<br />
<br />

<?
require_once App::getRoot() . "models/Themes.php";
$themes = new Themes();
$items2 = $themes->select();
?>
<h1>Список тем</h1>
<form action="/del/createTheme.php">
    <label>Создание новой темы:</label>
    <input name="themeName" placeholder="Введите название темы">
    <input type='hidden' name="idSuffix" formmethod="get" value="themes" />
    <button>Создать</button>
</form>
<br />
<table border="1">
    <tr>
        <th>Название темы</th>
        <th>Вопросы в теме</th>
        <th>Всего вопросов в теме</th>
        <th>Опубликованно вопросов</th>
        <th>Вопросов без ответа</th>
        <th>Удаление темы</th>
    </tr>
    <? foreach ($items2 as $value) { ?>
        <tr>
            <td><? echo $value['name_themes']; ?></td>
            <td><a href="/views/question/quetionsInTheme.php?table=themes&idSuffix=themes&id=<? echo $value['id_themes'] ?>">Вопросы в этой теме</a></td>
            <td><? echo $value['questions_all']; ?></td>
            <td><? echo $value['questions_published']; ?></td>
            <td><? echo $value['questions_unanswerd']; ?></td>
            <td><a href="/del/echoDel.php?table=themes&idSuffix=themes&id=<? echo $value['id_themes'] ?>">Удалить тему</a></td>
        </tr>
    <? } ?>
</table>




<br />
<br />



<?
require_once App::getRoot() . "models/Questions.php";
$questions = new Questions();
$items3 = $questions->select();
?>
<h1>Вопросы без ответа в порядке добавления</h1>

<br />
<table border="1">
    <tr>
        <th>Вопрос</th>
        <th>Новая редакция вопроса</th>
        <th>Дата добавления вопроса</th>
        <th>Удаление вопроса</th>

    </tr>
    <? foreach ($items3 as $value) { ?>
        <tr>
            <td><? echo $value['question']; ?></td>
            <td>
                <form action="/del/updateQuestion.php">
                    <input type='hidden' name="table" formmethod="get" value="questions" />
                    <input type='hidden' name="set" formmethod="get" value="question" />
                    <textarea name="setValue" title=""><? echo $value['question']; ?></textarea><br />
                    <input type='hidden' name="idSuffix" formmethod="get" value="questions" />
                    <input type='hidden' name="id" formmethod="get" value="<? echo $value['id_questions'] ?>" />
                    <button>Изменить вопрос</button>
                </form>
            </td>
            <td><? echo $value['date']; ?></td>
            <td><a href="/del/echoDel.php?table=questions&idSuffix=questions&id=<? echo $value['id_questions'] ?>">Удалить вопрос</a></td>
        </tr>
    <? } ?>
</table>
