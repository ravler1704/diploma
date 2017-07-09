<?php
namespace controllers;

use lib\Controller;
use models\Questions;
use models\Themes;

/*
 * Контроллер для операций с темами
 */
class ThemeController extends Controller
{
    // Экшены по созданию обновлению .... тем вопросов:

    public function indexAction()
    {
        $themeModel = new Themes();
        $themes = $themeModel->select();

        $this->render('theme/index', ['themes' => $themes, 'model' => $themeModel]);
    }

    public function deleteAction()
    {
        $id = $this->getParam('id');
        $model = new Themes();
        $model->delete(['id' => $id]);

        $this->redirect('theme/index');
    }

    public function deleteThemeAndQuestionsAction()
    {
        $id = $this->getParam('id');
        $themeModel = new Themes();
        $themeModel->delete(['id' => $id]);

        $questionModel = new Questions();
        $questionModel->delete(['theme_id' => $id]);

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
    }

    public function countAction()
    {
        $model = new Themes();
        $inputData = $this->getParam('Data');
        $countAll = $model->count(['id' => $inputData['id']]);

        return $countAll;
    }

}