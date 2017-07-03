<?php
namespace models;

use lib\App;

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
}