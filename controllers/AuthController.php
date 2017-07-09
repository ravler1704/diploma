<?php
namespace controllers;

use lib\App;
use models\Users;
use lib\Controller;


/**
 * Контроллер отвечающий за авторизацию.
 */
class AuthController extends Controller
{

    public function loginAction()
    {
        if (App::getUser()) {
            $this->redirect('question/index');
        }
        $userModel = new Users();
        $inputData = $this->getParam('Data');
        $errors = [];
        if ($inputData && !empty($inputData['name'])) {
            $users = $userModel->select(['name' => $inputData['name']]);
            foreach ($users as $user) {
                if ($user['password'] == $inputData['password']) {
                    unset($user['password']);
                    $_SESSION['user'] = $user;
                    $this->redirect('question/index');
                } else {
                    $errors[] = 'Неверный логин или пароль';
                }
            }
        }
        $this->render('auth/login', ['errors' => $errors]);
    }

    public function getLoggedUserDataAction()
    {
        if (empty($_SESSION['user'])) {
            return null;
        }
        return $_SESSION['user'];
    }

    public function logoutAction()
    {
        if (App::getUser()) {
            session_destroy();
        }
        $this->redirect('auth/login');
    }

}