<?php
require_once __DIR__ . '/../../lib/database/DataBase.php';

DataBase::insert($_GET['table'], $_GET['field'], $_GET['value']);
var_dump($_GET['table']);echo '<br />';
var_dump($_GET['field']);echo '<br />';
var_dump($_GET['value']);echo '<br />';

echo 'Обновлено<br />';
echo "<a href='/web/index.php?r=question/adminPanel'>В админ панель</a>";

//insert($table, array $fields, array $values)

