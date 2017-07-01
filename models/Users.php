<?php
namespace models;

use lib\App;

class Users extends Model
{
    public function getTableName()
    {
        return 'users';
    }
}