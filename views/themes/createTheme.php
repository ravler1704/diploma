<?php
require_once __DIR__ . '/../../lib/database/DataBase.php';

DataBase::insertTheme($_GET['themeName']);

echo 'Тема ' . $_GET['themeName'] . ' создана';
echo '<br />';
echo "<a href='/web/index.php?r=question/adminPanel'>В админ панель</a>";