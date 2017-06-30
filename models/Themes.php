<?php

class Themes extends Model
{
    public function getTableName()
    {
        return 'themes';
    }

    public function select(array $condition = [])
    {
        return App::getDb()->select($this->getTableName(), $condition);
    }
}