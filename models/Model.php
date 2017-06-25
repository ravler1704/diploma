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

    // TODO остальные операции ...
}