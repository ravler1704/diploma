<?php
namespace controllers;

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



        //$users = getUsersAction();
        $userModel = new Users();
        $inputData = $this->getParam('Data');
        $users = $userModel->select();
        foreach ($users as $user) {
            if ($user['name'] == $inputData['name'] && $user['password'] == $inputData['password']) {
                unset($user['password']);
                $_SESSION['user'] = $user;
                $_SESSION['flag'] = 'admin';
                $this->redirect('question/index');

                return true;
            }
        }
        return false;
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
        session_destroy();
        locationAction('index');
    }

}