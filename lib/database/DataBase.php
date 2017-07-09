<?php
namespace lib\database;

use PDOException;
use PDO;

/**
 * Класс для подключения к БД
 * Class DataBase
 * $db = new DataBase('localhost', 'faq', 'root', '');
 * $db->select(...)
 * $connection = $db->getConnection();
 */
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
     * @return array
     * Example
     * select('questions', ['author' => 'Make', '..' => '...'])
     */

    public function select($table, array $where = [])
    {
        $sql = "SELECT * FROM $table";
        $conditionParams = [];
        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                if (is_null($value)) {
                    $conditions[] = "(`$key` IS NULL OR  `$key` = '')";
                } else {
                    $conditionParams[":$key"] = $value;
                    $conditions[] = "`$key` = :$key";
                }
                //$conditionParams[":$key"] = $value;
                // $conditions[] = "`$key` = :$key";
            }
            $sqlCondition = implode(', ', $conditions);
            // $sql = $sql . '...'
            // `name` = :name, `age` = :age
            $sql .= " WHERE $sqlCondition";
        }

        $sth = $this->db->prepare($sql);
        $sth->execute($conditionParams);
        //:name => 'Ivan', `age` => 12

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count($table, array $where = [])
    {
        $sql = "SELECT COUNT(*) AS `count` FROM $table";
        $conditionParams = [];
        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                if (is_null($value)) {
                    $conditions[] = "(`$key` IS NULL OR  `$key` = '')";
                } else {
                    $conditionParams[":$key"] = $value;
                    $conditions[] = "`$key` = :$key";
                }
            }
            $sqlCondition = implode(' AND ', $conditions);
            // $sql = $sql . '...'
            // `name` = :name, `age` = :age
            $sql .= " WHERE $sqlCondition";
        }

        $sth = $this->db->prepare($sql);
        $sth->execute($conditionParams);
        //:name => 'Ivan', `age` => 12
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public function delete($table, array $where = [])
    {
        $sql = "DELETE FROM $table";
        $conditionParams = [];
        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditionParams[":$key"] = $value;
                $conditions[] = "`$key` = :$key";
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
        $conditionParams = [];
        $conditionsSet = [];
        foreach ($set as $key => $value) {
            $conditionParams[":$key"] = $value;
            $conditionsSet[] = "`$key` = :$key";
        }
        $sqlConditionSet = implode(', ', $conditionsSet);
        // $sql = $sql . '...'
        // `name` = :name, `age` = :age
        $sql .= " SET $sqlConditionSet";
        /*
         * WHERE
         */
        if (!empty($where)) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditionParams[":$key"] = $value;
                $conditions[] = "`$key` = :$key";
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
