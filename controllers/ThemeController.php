<?php
namespace controllers;

use lib\Controller;
use models\Themes;

/*
 * Контроллер для административной части сайта. SiteController наследует все св-ва и метода Controller
 */

class ThemeController extends Controller
{
    // Тут будут экшены по созданию обновлению .... тем вопросов.

    public function indexAction()
    {
        $themeModel = new Themes();
        $themes = $themeModel->select();

        $this->render('theme/index', ['themes' => $themes]);
    }

    public function indexDelete()
    {
        $id = $this->getParam('id');
        // Исользовать модель Questions в которой будут происходить запросы на удаления
        $model = new Themes();
        $model->delete(['id' => $id]);

        $this->redirect('theme/index');
    }
}