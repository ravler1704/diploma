<?php
require_once __DIR__ . '/../../lib/database/DataBase.php';



DataBase::updatePassword($_GET['userId'], $_GET['newPassword']);

echo '<br />';
echo "<a href='/web/index.php?r=question/adminPanel'>В админ панель</a>";

