<?php
namespace models;

use lib\App;

class Themes extends Model
{
    public function getTableName()
    {
        return 'themes';
    }

    public function getList()
    {
        $result = [];
        $themes = $this->select();
        foreach ($themes as $theme) {
            $result[$theme['id']] = $theme['name'];
        }
        return $result;
    }
}