<?php

abstract class Model
{
    abstract public function getTableName();

    public function insert(array $data)
    {
        App::getDb()->insert($this->getTableName(), $data);
    }

    public function update($data, array $condition = [])
    {
        App::getDb()->update($this->getTableName(), $data, $condition);
    }

    public function select(array $condition = [])
    {
        App::getDb()->select($this->getTableName(), $condition);
    }

    public function delete(array $condition = [])
    {
        App::getDb()->delete($this->getTableName(), $condition);
    }




    //TODO остальные операции ...  DONE!?
}