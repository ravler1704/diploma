<?php
require_once App::getRoot() . 'models/Model.php';

class Questions extends Model
{
    public function getTableName()
    {
        return 'questions';
    }

    public function delete($id){
        // Делаем запрос в базу на удаления
        // App::getDb()->delete(...)
    }
}