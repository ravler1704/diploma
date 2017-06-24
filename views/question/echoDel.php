<?php
require_once __DIR__ . '/../../lib/database/DataBase.php';

DataBase::delete($_GET['table'], $_GET['idSuffix'], $_GET['id']);


echo '<br />';
echo "<a href='/web/index.php?r=question/adminPanel'>В админ панель</a>";