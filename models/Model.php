<?php
namespace models;

use lib\App;

abstract class Model
{
    abstract public function getTableName();

    public function insert(array $data)
    {
        return App::getDb()->insert($this->getTableName(), $data);
    }

    public function update($data, array $condition = [])
    {
        return App::getDb()->update($this->getTableName(), $data, $condition);
    }

    public function select(array $condition = [])
    {
        return App::getDb()->select($this->getTableName(), $condition);
    }

    public function delete(array $condition = [])
    {
        App::getDb()->delete($this->getTableName(), $condition);
    }

    public function selectOne(array $condition = [])
    {
        $result =  App::getDb()->select($this->getTableName(), $condition);
        if (isset($result[0])) {
            return $result[0];
        }
    }

    public function count(array $condition = [])
    {
        return App::getDb()->select($this->getTableName(), $condition);
    }

}