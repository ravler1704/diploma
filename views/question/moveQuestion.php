<?php
require_once __DIR__ . '/../../lib/database/DataBase.php';

DataBase::update($_GET['table'], $_GET['set'], $_GET['setValue'], $_GET['idSuffix'],  $_GET['id']);


echo 'Перемещено<br />';
echo "<a href='/web/index.php?r=question/adminPanel'>В админ панель</a>";