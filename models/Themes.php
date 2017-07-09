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

    public function getAllQuestionsCount($themeId)
    {
        return App::getDb()->count('questions', ['theme_id' => $themeId]);
    }

    public function getPublishedQuestionsCount($themeId)
    {
        return App::getDb()->count('questions', ['status' => 'Опубликовано', 'theme_id' => $themeId]);
    }

    public function getNoAnswerQuestionsCount($themeId) {
        return App::getDb()->count('questions', ['theme_id' => $themeId, 'answer' => null]);
    }

}