<?php
namespace controllers;

use lib\Controller;
use models\Users;

/*
 * Контроллер для операций с пользователями
 */
class UserController extends Controller {

    //добавить администратора
    public function addAdminAction()
    {
        $model = new Users();
        $inputData = $this->getParam('Data');

        $model->insert(['name' => $inputData['name'], 'password' => $inputData['password']]);
        $this->redirect('question/index');
    }

    public function deleteAction()
    {
        $id = $this->getParam('id');
        $model = new Users();

        $model->delete(['id' => $id]);
        $this->redirect('question/index');
    }

    public function updatePasswordAction()
    {
        $inputData = $this->getParam('Data');
        $model = new Users();

        $model->update(['password' => $inputData['password']], ['id' => $inputData['id']]);
        // Переходим обратно на список вопросв в текущей теме.
        $this->redirect('question/index');
    }

}