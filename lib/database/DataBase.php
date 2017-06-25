<?php

/**
 * Класс для подключения к БД
 * Class DataBase
 * $db = new DataBase('localhost', 'faq', 'root', '');
 * $db->select(...)
 * $connection = $db->getConnection();
 */
// TODO Привести к номральному виду комментарии
class DataBase
{
    private $db;

    function __construct($dsn, $user, $pass)
    {
        try {                                                                                //Код генерирующий исключение
            $this->db = new PDO($dsn, $user, $pass);
        } catch (PDOException $e) {                                                         //перехватыватывает исключение если оно возникло
            die('Database error: ' . $e->getMessage() . '<br/>');                               //Выводит сообщение и прекращает выполнение текущего скрипта
        }
    }

    function getConnection()
    {
        return $this->db;
    }

    /**
     * @param $table
     * @param array $where
     * @return PDOStatement
     * Example
     * select('questions', ['author' => 'Make', '..' => '...'])
     * TODO: Можно уосвершенствовать функцию, чтобы еще была возможность указывать операцию: select('questions', [['>', 'author' => 'Make'], ...)
     */
    public function select($table, array $where = [])
    {

        $sql = "SELECT * FROM $table";
        $conditionParams = [];
        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditionParams[":$key"] = $value;
                $conditions[] = "`$key` = :$value";
            }
            $sqlCondition = implode(', ', $conditions);
            // $sql = $sql . '...'
            // `name` = :name, `age` = :age
            $sql .= " WHERE $sqlCondition";
        }

        $sth = $this->db->prepare($sql);
        //:name => 'Ivan', `age` => 12
        $sth->execute($conditionParams);
        return $sth;

    }

    // TODO Убрать. Использовать select
    public function selectThemes($condition, $table, $column, $value)
    {                                                //отображение тем
        $sth = $this->getConnection()->prepare("SELECT $condition FROM $table WHERE `$column` = $value");
        $sth->execute();
        return $sth;

    }

    // TODO ...
    public function delete($table, array $where = [])
    {                                                           //удаление администратора
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("DELETE FROM `$table` WHERE `id_$idSuffix` = $id");
        $sth->execute();
        echo 'Удалено';

    }

    // TODO Убрать. Использовать update
    public function updatePassword($id_user, $new_password)
    {                                            //смена пароля администратора
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("UPDATE `users` SET `password_users`= $new_password WHERE `id_users` = $id_user");
        $sth->execute();
        echo 'Пароль изменен';

    }

    // TODO Убрать. Использовать insert
    public function insertTheme($nameTheme)
    {                                                                 //добавление записи
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("INSERT INTO `themes`(`name_themes`) VALUES ('$nameTheme')");
        $sth->execute();
        return $sth;

    }

    /**
     * @param $table
     * @param array $data
     * @return PDOStatement
     * Example:
     * insert('questions', ['question' => 'What is...', 'author' => 'Mike'])
     */
    public function insert($table, array $data)
    {
        $values = [];
        $columns = [];
        $columnsVal = [];
        foreach ($data as $key => $value) {
            $columns[] = "`$key`";
            $columnsVal[] = ":$key";
            $values[":$key"] = $value;
        }
        $sqlColumns = implode(', ', $columns);
        $sqlColumnsVal = implode(', ', $columnsVal);

        // INSERT INTO `table` (`x1`, `x2`) VALUES(:x1, :x2)
        $sth = $this->getConnection()->prepare("INSERT INTO `$table`($sqlColumns) VALUES ($sqlColumnsVal)");
        // Указываем что вместо плейсхолдеров :x1, x2 подставляем реальные значения
        $sth->execute($values);
        return $sth;

    }

    // TODO Убрать. Использовать insert
    public function insertNewQuestion($table, array $fields, array $values)
    {                                                                 //
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("INSERT INTO `$table`(`$fields`) VALUES ('$values')");
        $sth->execute();
        return $sth;

    }

    // TODO ...
    public function update($table, array $values, array $where = [])
    {                                                         //корректировка
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        // UPDATE `table` SET `name` = :name, ... WHERE `id` = :id
        $sth = $db->prepare("UPDATE `$table` SET `$set`='$setValue' WHERE `id_$idSuffix`=$id");
        // заменить плейсхолдеры ....
        $sth->execute();
        return $sth;

    }

    // TODO Убрать. Использовать select
    public function selectQuestionName($id)
    {                                                         //
        $db = DataBase::connect('localhost', 'faq', 'root', '');
        $sth = $db->prepare("SELECT `*` FROM `themes` WHERE `id_themes`=$id");
        $sth->execute();
        return $sth;

    }
}




