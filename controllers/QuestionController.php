<?php
namespace controllers;

use lib\Controller;
use models\Questions;
use models\Themes;
use models\Users;
use lib\App;

/**
 * Контроллер для операций с вопросами
 */
class QuestionController extends Controller
{

    public function indexAction()
    {
        $questionModel = new Questions();
        $questions = $questionModel->select(['answer' => NULL]);

        $userModel = new Users();
        $users = $userModel->select();

        $this->render('question/index', ['questions' => $questions, 'users' => $users]);
    }


    //Задать вопрос
    public function askQuestionAction()
    {
        $model = new Questions();
        //$x = $_POST['Data'];
        //$x будет равен ['question' => '....' , 'id' => '...']

        // $_REQUEST['Data']
        $inputData = $this->getParam('Data');
        $model->insert(['author' => $inputData['author'], 'email' => $inputData['email'], 'question' => $inputData['question'], 'theme_id' => $inputData['theme_id']]);
        $this->redirect('site/index');
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

        $modelTheme = new Themes();
        $themeList = $modelTheme->getList();

        $this->render('question/create', ['themeList' => $themeList]);
    }

    public function deleteAction()
    {
        $id = $this->getParam('id');
        // Исользовать модель Questions в которой будут происходить запросы на удаления
        $model = new Questions();
        $model->delete(['id' => $id]);

        $this->redirect('question/index');
    }

    public function deleteQuestionInThemeAction()
    {
        $id = $this->getParam('id');
        $currentThemeId = $this->getParam('theme_id');
        // Исользовать модель Questions в которой будут происходить запросы на удаления
        $model = new Questions();
        $model->delete(['id' => $id]);

        $this->redirect('question/theme', ['id' => $currentThemeId]);
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

/*
 * UPDATE
 */
    public function updateAuthorAction()
    {
        $currentThemeId = $this->getParamGet('id');
        $model = new Questions();
        $inputData = $this->getParam('Data');

        $model->update(['author' => $inputData['author']], ['id' => $inputData['id']]);
        // Переходим обратно на список вопросв в текущей теме.
        $this->redirect('question/theme', ['id' => $currentThemeId]);
    }

    public function updateAnswerAction()
    {
        $model = new Questions();
        $inputData = $this->getParam('Data');
        if (isset($inputData['publishButton'])) {
            $model->update(['answer' => $inputData['answer'], 'status' => 'Опубликовано'], ['id' => $inputData['id']]);
        } else if (isset($inputData['saveButton'])) {
            $model->update(['answer' => $inputData['answer'], 'status' => 'Не опубликовано'], ['id' => $inputData['id']]);
        }
        // Переходим обратно на список вопросв в текущей теме.
        $this->redirect('question/theme', ['id' => $inputData['theme_id']]);

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
    }

    public function updateInThemeAction()
    {
        $model = new Questions();
        //$x = $_POST['Data'];
        // $x будет равен ['question' => '....' , 'id' => '...']

        // $_REQUEST['Data']
        $inputData = $this->getParam('Data');

        $model->update($inputData, ['id' => $inputData['id']]);
        $this->redirect('question/theme', ['id' => $inputData['theme_id']]);
    }

    public function updateStatusAction()
    {
        //$currentThemeId = $this->getParamGet('id');
        $model = new Questions();
        $inputData = $this->getParam('Data');

        if ($inputData['status'] == 'Не опубликовано') {
            $model->update(['status' => 'Опубликовано'], ['id' => $inputData['id']]);
        } else {
            $model->update(['status' => 'Не опубликовано'], ['id' => $inputData['id']]);
        }
        $this->redirect('question/theme', ['id' => $inputData['theme_id']]);
    }

}