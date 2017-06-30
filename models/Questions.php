<?php
require_once App::getRoot() . 'models/Model.php';

class Questions extends Model
{
    public function getTableName()
    {
        return 'questions';
    }

   /* public function delete($id){
        // Делаем запрос в базу на удаления
        // App::getDb()->delete(...)
    }*/

    public function delete(array $condition = [])
    {
        App::getDb()->delete($this->getTableName(), $condition);
    }

    public function select(array $condition = [])
    {
        return App::getDb()->select($this->getTableName(), $condition);
    }
}