<?php
namespace controllers;

use lib\Controller;
use models\Questions;
use models\Themes;
use models\Users;

/**
 * Контроллер для административной части сайта. SiteController наследует все св-ва и метода Controller
 */
class QuestionController extends Controller
{
    public function indexAction()
    {
        $questionModel = new Questions();
        $questions = $questionModel->select();

        $userModel = new Users();
        $users = $userModel->select();
        $this->render('question/index', ['questions' => $questions, 'users' => $users]);
    }

    public function updateAction()
    {
        $model = new Questions();
        //$x = $_POST['Data'];
        // $x будет равен ['question' => '....' , 'id' => '...']

        // $_REQUEST['Data']
        $inputData = $this->getParam('Data');
        $model->update($inputData, ['id' => $inputData['id']]);
        $this->redirect('question/index');
        //$this->render('question/update');
    }

    public function createAction()
    {
        require_once App::getRoot() . 'models/Questions.php';
        $model = new Questions();
        if (!empty($_POST)) {
            //$model->insert($_POST);
            // Переход на index.php?r=question/index
            $this->redirect('question/index');
        }

        $this->render('question/create');
    }

    // Пример того что абстрактный метод напрямую использовать нельзя,
    // от абстрактного метода можно только унаследоваться другим классом
    public function someAction(){
        //$model = new Model();
        $model->insert($_POST['.....']);
    }

    public function deleteAction()
    {
        $id = $this->getParam('id');
        // Исользовать модель Questions в которой будут происходить запросы на удаления
        $model = new Questions();
        $model->delete(['id' => $id]);

        $this->redirect('question/index');
    }

    public function loginAction()
    {
        $this->render('question/login');
    }

    public function adminPanelAction()
    {
        $this->render('question/adminPanel');
    }

    public function themeAction()
    {
        $modelQuestion = new Questions();
        $id = $this->getParam('id');
        $questions = [];
        if (!empty($id)) {
            $questions = $modelQuestion->select(['theme_id' => $id]);
        }

        $modelTheme = new Themes();
        $currentTheme = $modelTheme->selectOne(['id' => $id]);
        $themeList = $modelTheme->getList();
        $this->render('question/theme', ['questions' => $questions, 'theme' => $currentTheme, 'themeList' => $themeList]);
    }

    public function moveAction()
    {
        $currentThemeId = $this->getParamGet('id');
        $model = new Questions();
        $inputData = $this->getParam('Data');
        $model->update(['theme_id' => $inputData['theme_id']], ['id' => $inputData['id']]);
        $this->redirect('question/theme', ['id' => $currentThemeId]);
    }

    public function updateAuthorAction()
    {
        $currentThemeId = $this->getParamGet('id');
        $model = new Questions();
        $inputData = $this->getParam('Data');
        $model->update(['author' => $inputData['author']], ['id' => $inputData['id']]);
        // Переходим обратно на список вопросв в текущей теме.
        $this->redirect('question/theme', ['id' => $currentThemeId]);
    }

}