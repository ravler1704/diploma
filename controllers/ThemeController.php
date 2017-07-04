<?php
namespace controllers;

use lib\Controller;
use lib\App;
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

    public function deleteAction()
    {
        $id = $this->getParam('id');
        // Исользовать модель Questions в которой будут происходить запросы на удаления
        $model = new Themes();
        $model->delete(['id' => $id]);

        $this->redirect('theme/index');
    }

    public function insertThemeAction()
    {
        $model = new Themes();
        //$x = $_POST['Data'];
        // $x будет равен ['question' => '....' , 'id' => '...']

        // $_REQUEST['Data']
        $inputData = $this->getParam('Data');
        $model->insert(['name' => $inputData['name']]);
        $this->redirect('theme/index');
        //$this->render('question/update');
    }

    public function countAction()
    {
        $model = new Themes();
        $inputData = $this->getParam('Data');
        $countAll = $model->count(['id' => $inputData['id']]);

        return $countAll;
    }



}