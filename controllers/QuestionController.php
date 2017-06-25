<?php

// Контроллер админа
class QuestionController extends Controller                                 //Контроллер для административной части сайта. SiteController наследует все св-ва и метода Controller
{
    public function indexAction()
    {
        $this->render('question/index');
    }

    public function updateAction()
    {
        $model = new Questions();
        $model->update($_POST['.....']);
        $this->render('question/update');
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
        // Исользовать модель Questions в которой будут происходить запросы на удаления
        /**
         * $id = $_GET['id'];
         * $model = new Questions();
         * $model->delete($id);
         */
    }

    public function loginAction()
    {
        $this->render('question/login');
    }

    public function adminPanelAction()
    {
        $this->render('question/adminPanel');
    }

}