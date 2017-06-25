<?php
require_once __DIR__ . '/../../lib/database/DataBase.php';

DataBase::insertNewQuestion($_GET['table'], ['author', 'email', 'question'], [$_GET['author'], $_GET['email'], $_GET['question']]);


echo 'Добавлено/Обновлено<br />';
echo "<a href='/web/index.php?r=question/adminPanel'>В админ панель</a>";
