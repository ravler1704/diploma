<?php

class Admins
{

// Получение всех администраторов
    public function findAllAdmins()
    {

    }

}


/*

<?php
include 'C:\Open\domains\dip\1\index.php';
$sth = $db->prepare("SELECT * FROM users");
$sth->execute();


foreach ($sth as $key => $value) {
    echo '<table>';
    echo '<tr>';
    echo '<td>' . $value['id_users'] . '</td>' . "\n";
    echo '<td>' . $value['name_users'] . '</td>' . "\n";
    echo '</tr>';
}
echo '</table>';
?>

*/