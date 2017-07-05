<!--<h1>Вход в админ панель</h1>
<form>
    <input type="text" name="name" placeholder="Введите логин">
    <input type="text" name="password" placeholder="Введите пароль">

    <button>Отправить</button>
</form>-->




<?php /*
require_once 'core.php';
$errors = array();
if (isPOST()) {
    if (login(getParam('login'), getParam('password'))) {
        location('admin');

    } elseif (loginGuest(getParam('loginGuest'))){
        location('list');
    }	else {
        $errors[] = 'Неверный логин или пароль.';
    }
}

*/?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
<h1>Вход в админ панель</h1>
<ul>
    <? /*foreach ($errors as $error):*/ ?>
        <li><?/*= $error */?></li>
    <?/* endforeach; */?>
</ul>

<form method="POST">
    <label for="login">Логин</label>
    <input name="login" id="login">

    <label for="password">Пароль</label>
    <input name="password" id="password">

    <button type="submit">Войти</button>
</form>
<br />
<br />
<br />
</html>