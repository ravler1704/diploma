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
        //Код генерирующий исключение
        try {
            $this->db = new PDO($dsn, $user, $pass);
          //перехватыватывает исключение если оно возникло
        } catch (PDOException $e) {
            //Выводит сообщение и прекращает выполнение текущего скрипта
            die('Database error: ' . $e->getMessage() . '<br/>');
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

    public function delete($table, array $where = [])
    {

        $sql = "DELETE * FROM $table";
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

    public function update($table, array $set = [], array $where = [])
    {
        $sql = "UPDATE $table";

        /*
         * SET
         */
        $conditionParamsSet = [];

        $conditionsSet = [];
        foreach ($set as $key => $value) {
            $conditionParamsSet[":$key"] = $value;
            $conditionsSet[] = "`$key` = :$value";
        }
        $sqlConditionSet = implode(', ', $conditionsSet);
        // $sql = $sql . '...'
        // `name` = :name, `age` = :age
        $sql .= " SET $sqlConditionSet";

        /*
         * WHERE
         */
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

}
