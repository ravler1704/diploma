<?php
namespace controllers;

use lib\App;
use models\Users;
use lib\Controller;


class AuthController extends Controller
{

    /*public function getUsersAction()
    {
        //$path = __DIR__ . '/data/users.json';
        //$fileData = file_get_contents($path);
        //$data = json_decode($fileData, true);
        $userModel = new Users();
        $data = $userModel->select();

        if (!$data) {
            return array();
        }
        return $data;
    }*/

    public function loginAction()
    {
        if (App::getUser()) {
            $this->redirect('question/index');
        }
        //$users = getUsersAction();
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

    public function isAuthorizedAction()
    {
        return getLoggedUserData() !== null;
    }

    /*
    public function getUserNameAction()
    {
        if (is_string($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            return $_SESSION['user']['name'];
        }
    }*/

    public function isPOSTAction()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function getParamAction($name)
    {
        return filter_input(INPUT_POST, $name);
    }

    public function locationAction($path)
    {
        header("Location: $path.php");
        die;
    }

    public function logoutAction()
    {
        if (App::getUser()) {
            session_destroy();
        }
        $this->redirect('auth/login');
    }

}