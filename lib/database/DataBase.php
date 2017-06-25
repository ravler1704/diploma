<?php

class DataBase                                                                              //класс для подключения к БД
{
	/**
	 * Подключение к базе данных mysql
	 */
	public static function connect($host, $dbname, $user, $pass)                            // static - позволяет обращаться к классу без создания экземпляра класса
	{
		try {                                                                                //Код генерирующий исключение
			$db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $pass);
		} catch (PDOException $e) {                                                         //перехватыватывает исключение если оно возникло
			die('Database error: '.$e->getMessage().'<br/>');                               //Выводит сообщение и прекращает выполнение текущего скрипта
		}
		return $db;                                                                         //Возвращает массив для подключения к БД
	}

	public static function select($condition, $table) {                                                                 //отображение администраторов в таблице
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("SELECT $condition FROM $table");
        $sth->execute();
        return $sth;

    }

    public static function selectThemes($condition, $table, $column, $value) {                                                //отображение тем
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("SELECT $condition FROM $table WHERE `$column` = $value");
        $sth->execute();
        return $sth;

    }

    public static function delete($table, $idSuffix, $id) {                                                           //удаление администратора
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("DELETE FROM `$table` WHERE `id_$idSuffix` = $id");
        $sth->execute();
        echo 'Удалено';

    }

    public static function updatePassword($id_user, $new_password) {                                            //смена пароля администратора
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("UPDATE `users` SET `password_users`= $new_password WHERE `id_users` = $id_user");
        $sth->execute();
        echo 'Пароль изменен';

    }

    public static function insertTheme($nameTheme) {                                                                 //добавление записи
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("INSERT INTO `themes`(`name_themes`) VALUES ('$nameTheme')");
        $sth->execute();
        return $sth;

    }

    public static function insert($table, $field, $value) {                                                                 //
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("INSERT INTO `$table`(`$field`) VALUES ('$value')");
        $sth->execute();
        return $sth;

    }

    public static function insertNewQuestion($table, array $fields, array $values) {                                                                 //
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("INSERT INTO `$table`(`$fields`) VALUES ('$values')");
        $sth->execute();
        return $sth;

    }



    public static function update($table, $set, $setValue, $idSuffix, $id) {                                                         //корректировка
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("UPDATE `$table` SET `$set`='$setValue' WHERE `id_$idSuffix`=$id");
        $sth->execute();
        return $sth;

    }

    public static function selectQuestionName($id) {                                                         //
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("SELECT `*` FROM `themes` WHERE `id_themes`=$id");
        $sth->execute();
        return $sth;

    }

    // UPDATE users SET name = '...' WHERE ...
    // update('users', ['name' => 'Иван', 'email' => ''], 'is_admin = 1 AND ....')
    public function update2($table, array $data, $condition = null) {
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("UPDATE `questions` SET `question`=[value-2]");
        $sth->execute();
        echo 'Удалено';

    }
}




